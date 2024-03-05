let mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management https://laravel-mix.com/docs/6.0/api
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix
    // Make sure the public path is declared
    .setPublicPath('public')

    // Simple ES6 JavaScript
    .js('resources/js/main.js', 'public/application/js/main.js')

    // CSS Compilation
    .sass('resources/css/main.scss', 'public/application/css/main.css')
