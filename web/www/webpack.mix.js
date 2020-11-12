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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');


mix.sass('resources/sass/frontend/app.scss', 'public/frontend/css')
.sass('resources/sass/frontend/home.scss', 'public/frontend/css')
.sass('resources/sass/frontend/about.scss', 'public/frontend/css')
.sass('resources/sass/frontend/policy.scss', 'public/frontend/css');
