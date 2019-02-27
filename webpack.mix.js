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

mix.copy('public/css/bootstrap.min.css', 'resources/assets/css/bootstrap.min.css');
mix.copy('public/css/main.css', 'resources/assets/css/main.css');
mix.copy('public/css/jquery-ui.css', 'resources/assets/css/jquery-ui.css');
mix.copy('public/css/select2.min.css', 'resources/assets/css/select2.min.css');

mix.styles([

    'public/css/bootstrap.min.css',
    'public/css/main.css',
    'public/css/jquery-ui.css',
    'public/css/select2.min.css'

], 'public/css/all.css');


mix.copy('public/js/jquery-3.2.1.js', 'resources/assets/js/jquery-3.2.1.js');
mix.copy('public/js/jquery-ui.js', 'resources/assets/js/jquery-ui.js');
mix.copy('public/js/jquery.sticky.js', 'resources/assets/js/jquery.sticky.js');
mix.copy('public/js/bootstrap.min.js', 'resources/assets/js/bootstrap.min.js');
mix.copy('public/js/main.js', 'resources/assets/js/main.js');
mix.copy('public/js/select2.min.js', 'resources/assets/js/select2.min.js');


mix.scripts([

    'public/js/jquery-3.2.1.js',
    'public/js/jquery-ui.js',
    'public/js/jquery.sticky.js',
    'public/js/bootstrap.min.js',
    'public/js/main.js',
    'public/js/select2.min.js'

], 'public/js/all.js');
