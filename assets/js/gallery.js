require('./app')
import PhotoSwipe from 'photoswipe'
import PhotoSwipeUI_Default from 'photoswipe/src/js/ui/photoswipe-ui-default';

function parseThumbnailElements(el) {
  let thumbElements = el.childNodes,
    numNodes = thumbElements.length,
    items = [],
    listEl,
    $linkEl,
    size,
    item,
    $figCaption,
    $img;

  for(let i = 0; i < numNodes; i++) {
    listEl = thumbElements[i]; // <figure> element
    // include only element nodes
    if(listEl.nodeType !== 1) {
      continue;
    }

    $linkEl = $('.gallery-link', listEl);
    size = [
      $('meta[itemprop=width]', listEl).attr('content'),
      $('meta[itemprop=height]', listEl).attr('content')
    ];

    // create slide object
    item = {
      src: $linkEl.attr('href'),
      w: parseInt(size[0], 10),
      h: parseInt(size[1], 10)
    };


    $figCaption = $('figcaption', listEl);
    if($figCaption.length > 0) {
      item.title = $figCaption.html();
    }

    $img = $('.gallery-image', listEl)
    if($img.length > 0) {
      item.msrc = $img.attr('src');
    }

    item.el = listEl; // save link to element for getThumbBoundsFn
    items.push(item);
  }

  return items;
}

function closest (el, fn) {
  return el && ( fn(el) ? el : closest(el.parentNode, fn) );
}

function onThumbnailsClick(e) {
  e = e || window.event;
  e.preventDefault ? e.preventDefault() : e.returnValue = false;

  let eTarget = e.target || e.srcElement;

  // find root element of slide
  let clickedListItem = closest(eTarget, function(el) {
    return (el.tagName && el.tagName.toUpperCase() === 'LI');
  });

  if(!clickedListItem) {
    return;
  }

  let clickedGallery = clickedListItem.parentNode,
    childNodes = clickedListItem.parentNode.childNodes,
    numChildNodes = childNodes.length,
    nodeIndex = 0,
    index;

  for (let i = 0; i < numChildNodes; i++) {
    if(childNodes[i].nodeType !== 1) {
      continue;
    }

    if(childNodes[i] === clickedListItem) {
      index = nodeIndex;
      break;
    }
    nodeIndex++;
  }

  if(index >= 0) {
    openPhotoSwipe(index, clickedGallery);
  }
  return false;
}

function photoswipeParseHash() {
  let hash = window.location.hash.substring(1),
    params = {};

  if(hash.length < 5) {
    return params;
  }

  let lets = hash.split('&');
  for (let i = 0; i < lets.length; i++) {
    if(!lets[i]) {
      continue;
    }
    let pair = lets[i].split('=');
    if(pair.length < 2) {
      continue;
    }
    params[pair[0]] = pair[1];
  }

  if(params.gid) {
    params.gid = parseInt(params.gid, 10);
  }

  return params;
}

function openPhotoSwipe(index, galleryElement, disableAnimation, fromURL) {
  let pswpElement = document.querySelectorAll('.pswp')[0],
    gallery,
    options,
    items;

  items = parseThumbnailElements(galleryElement);

  options = {
    getThumbBoundsFn: function(index) {
      let thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
        rect = thumbnail.getBoundingClientRect();
      return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
    },
    showHideOpacity: true,
    bgOpacity: 0.9
  }

  // PhotoSwipe opened from URL
  if(fromURL) {
    if(options.galleryPIDs) {
      // parse real index when custom PIDs are used
      // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
      for(let j = 0; j < items.length; j++) {
        if(items[j].pid === index) {
          options.index = j;
          break;
        }
      }
    } else {
      // in URL indexes start from 1
      options.index = parseInt(index, 10) - 1;
    }
  } else {
    options.index = parseInt(index, 10);
  }

  // exit if index not found
  if( isNaN(options.index) ) {
    return;
  }

  if(disableAnimation) {
    options.showAnimationDuration = 0;
  }

  // Pass data to PhotoSwipe and initialize it
  gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
  gallery.init();
}

function initPhotoSwipeFromDOM(gallerySelector) {
  let galleryElements = document.querySelectorAll( gallerySelector );
  for(let i = 0, l = galleryElements.length; i < l; i++) {
    galleryElements[i].setAttribute('data-pswp-uid', i+1);
    galleryElements[i].onclick = onThumbnailsClick;
  }

  // Open photoswipe to current hash if linked straight to image
  let hashData = photoswipeParseHash();
  if(hashData.pid && hashData.gid) {
    openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
  }
}

initPhotoSwipeFromDOM('.gallery-thumbs');
