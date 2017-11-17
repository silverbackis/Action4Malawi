var Encore = require('@symfony/webpack-encore');

Encore
    .enablePostCssLoader()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('css/app', './assets/css/app.sass')
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

module.exports = Encore.getWebpackConfig();
