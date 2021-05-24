const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.sass('resources/sass/app.scss', 'public/css/style.css');
mix.sass('resources/sass/signin.scss', 'public/css/signin.css');
mix.sass('resources/sass/admin.scss', 'public/css/admin.css');
mix.js('resources/js/main.js', 'public/js/main.js');
mix.js('resources/js/admin.js', 'public/js/admin.js');
mix.js('resources/js/input_limit.js', 'public/js/input_limit.js');
mix.js('resources/js/calculate.js', 'public/js/calculate.js');
mix.js('resources/js/image_review.js', 'public/js/image_review.js');
mix.js('resources/js/card_list.js', 'public/js/card_list.js');
