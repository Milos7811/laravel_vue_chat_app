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

 mix.js('resources/js/main.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')

    .postCss("resources/css/tailwind.css", "public/css/tailwind.css", [
        require("tailwindcss"),
    ])

    .webpackConfig({
        output: {
            chunkFilename: '[name].js?id=[chunkhash]',
        }
    })
    // .options({
    //     hmrOptions: {
    //         host: '127.0.0.1',
    //         port: '8080'
    //     },
    // })

 .disableNotifications();
