let mix = require('laravel-mix');

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

mix
   /* CSS */
   .sass('resources/assets/styles/app.scss', 'public/styles/app.css')
   
   /* JS */
   .js('resources/assets/scripts/laravel/app.js', 'public/scripts/app.js')
   .js('resources/assets/scripts/dashmix/app.js', 'public/scripts/gui.js')

   /* Assets */
   .copyDirectory('resources/assets/fonts', 'public/fonts');