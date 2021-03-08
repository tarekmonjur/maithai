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


// const themes = ['theme1', 'theme2', 'theme3'];
const themes = ['theme3'];

themes.forEach(theme => {
  // mix.sass('resources/assets/'+theme+'/scss/app.scss', 'public/'+theme+'/css')
  // mix.vue3('resources/assets/'+theme+'/js/home.js', 'public/'+theme+'/js');
  mix.vue3('resources/assets/'+theme+'/js/product.js', 'public/'+theme+'/js');
  // mix.vue3('resources/assets/'+theme+'/js/package.js', 'public/'+theme+'/js');
  // mix.vue3('resources/assets/'+theme+'/js/login.js', 'public/'+theme+'/js');
  // mix.vue3('resources/assets/'+theme+'/js/signup.js', 'public/'+theme+'/js');
  // mix.vue3('resources/assets/'+theme+'/js/about.js', 'public/'+theme+'/js');
  // mix.vue3('resources/assets/'+theme+'/js/contact.js', 'public/'+theme+'/js');
  // mix.vue3('resources/assets/'+theme+'/js/policy.js', 'public/'+theme+'/js');
  // mix.vue3('resources/assets/'+theme+'/js/my_order.js', 'public/'+theme+'/js');
  // mix.vue3('resources/assets/'+theme+'/js/payment_alert.js', 'public/'+theme+'/js');
  // mix.vue3('resources/assets/'+theme+'/js/gallery.js', 'public/'+theme+'/js');
});

// mix.sass('resources/assets/backend/scss/style.scss', 'public/backend/css');
mix.vue3('resources/assets/backend/js/category.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/sub_category.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/unit.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/variant.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/sub_variant.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/product.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/customer.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/pos.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/order.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/sku.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/table.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/user.js', 'public/backend/js');
// mix.vue3('resources/assets/backend/js/settings.js', 'public/backend/js');


