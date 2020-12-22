const mix = require('laravel-mix');
require("laravel-mix-vue3");
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
//    .sass('resources/sass/app.scss', 'public/css');


// mix.sass('resources/assets/frontend/scss/app.scss', 'public/frontend/css')
// mix.sass('resources/assets/backend/scss/style.scss', 'public/backend/css');


mix.vue3('resources/assets/backend/js/category.js', 'public/backend/js');
mix.vue3('resources/assets/backend/js/sub_category.js', 'public/backend/js');
mix.vue3('resources/assets/backend/js/unit.js', 'public/backend/js');
mix.vue3('resources/assets/backend/js/variant.js', 'public/backend/js');
mix.vue3('resources/assets/backend/js/sub_variant.js', 'public/backend/js');
mix.vue3('resources/assets/backend/js/product.js', 'public/backend/js');
mix.vue3('resources/assets/backend/js/customer.js', 'public/backend/js');


