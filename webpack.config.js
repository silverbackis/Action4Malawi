let webpack = require('webpack');
let Encore = require('@symfony/webpack-encore');

Encore
  .enableSingleRuntimeChunk()
  .enablePostCssLoader()
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .addEntry('js/app', './assets/js/app.js')
  .addEntry('js/gallery', './assets/js/gallery.js')
  .addStyleEntry('css/app', './assets/css/app.sass')
  .addStyleEntry('css/home', './assets/css/home.sass')
  .addStyleEntry('css/form', './assets/css/form.sass')
  .addStyleEntry('css/gallery', './assets/css/gallery.sass')
  .enableSassLoader()
;

if (Encore.isProduction()) {
  Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .enableVersioning()
  ;
} else {
  Encore
    .setOutputPath('public/build/')
    .setPublicPath('http://localhost:8080/')
    .setManifestKeyPrefix('build/')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps()
  ;
}

let config = Encore.getWebpackConfig();

config.plugins.push(new webpack.ProvidePlugin({
  $: 'jquery',
  jQuery: 'jquery',
  'window.jQuery': 'jquery',
  Popper: ['popper.js', 'default']
}));

module.exports = config;
