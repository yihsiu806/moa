const mix = require('laravel-mix');
require ('laravel-mix-svelte');

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

mix
.js('resources/js/app.js', 'public/js')
.js('resources/js/myupload.js', 'public/js')
.js('resources/js/welcome.js', 'public/js')
.js('resources/js/edit-division.js', 'public/js')
.js('resources/js/file-upload.js', 'public/js')
.js('resources/js/admin-dashboard.js', 'public/js')
.js('resources/js/file-viewer.js', 'public/js')
.js('resources/js/add-user.js', 'public/js')
.js('resources/js/edit-user.js', 'public/js')
.js('resources/js/sidebar.js', 'public/js')
.js('resources/js/viewer-dashboard.js', 'public/js')
.js('resources/js/file-edit.js', 'public/js')
.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])
.postCss('resources/css/login.css', 'public/css')
.svelte();

mix.webpackConfig({
    output: {
        chunkFilename: 'js/[name].js?id=[chunkhash]',
    },
});
