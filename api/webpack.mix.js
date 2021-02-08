const mix = require('laravel-mix');
const webpack = require('webpack');
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
    // Landing page
    .styles([
        'resources/css/landing.css',
    ], 'public/css/landing.css').version()

    // Main Theme
    .styles([
        'resources/css/argon.css',
        'resources/css/loading.css',
    ], 'public/css/main.css').version()


    // Vue - Customer
    .js('resources/js/customer/app.js', 'public/js/customers/').version()



    .sass('resources/sass/app.scss', 'public/css').version();

if (mix.inProduction()) {
    mix.version();
}


module.exports = {
    configureWebpack: {
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'windows.jQuery': 'jquery',
            }),
        ],
    },
};
