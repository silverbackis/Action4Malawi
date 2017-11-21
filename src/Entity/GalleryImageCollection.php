<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;

class GalleryImageCollection
{
    const FILE_EXT = ['jpg', 'jpeg', 'png'];
    /**
     * @var ArrayCollection
     */
    private $images;

    public function __construct(
        Finder $finder,
        string $splitDir
    )
    {
        $this->images = new ArrayCollection();
        foreach ($finder as $file) {
            $galleryImage = new GalleryImage($file, $splitDir);
            if ($galleryImage->getPath()) {
                $this->images->add($galleryImage);
            }
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getImages(): ArrayCollection
    {
        return $this->images;
    }
}