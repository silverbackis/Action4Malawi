let webpack = require('webpack');
let Encore = require('@symfony/webpack-encore');

Encore
  .enablePostCssLoader()
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .addEntry('js/app', './assets/js/app.js')
  .addStyleEntry('css/app', './assets/css/app.sass')
  .addStyleEntry('css/home', './assets/css/home.sass')
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
