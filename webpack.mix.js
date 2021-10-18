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
//everything to do with javascript gets compiled into this folder
mix.js('resources/js/app.js', 'public/js')
    //everything to do with css gets compiled into this folder
    .sass('resources/sass/app.scss', 'public/css');

mix.browserSync({
    proxy: 'vinyl_shop.test',
    port: 3000
});
