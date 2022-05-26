const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/shop.js', 'public/js/shop.js')
    .js('resources/js/goods.js','public/js/goods.js')
    .js('resources/js/collections.js','public/js/collections.js')
    .js('resources/js/sellers.js','public/js/sellers.js')
    .js('resources/js/brands.js','public/js/brands.js')
    .js('resources/js/categories.js','public/js/categories.js')
    .extract(['bootstrap']);
mix.sass('resources/sass/app.scss', 'public/css');
