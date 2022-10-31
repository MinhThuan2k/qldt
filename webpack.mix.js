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


// mix.styles([
//     'public/css/bootstrap.min.css',
//     'public/css/bootstrap-timepicker.min.css',
//     'public/css/lte.css'
// ], 'public/css/all.css').version();

mix.js('resources/js/auth/don-vi/don-vi.js', 'public/js').version();
