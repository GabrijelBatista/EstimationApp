const mix = require('laravel-mix');
const webpack = require('webpack')

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

mix.js('resources/js/app.js', 'public/js')
    .vue({version: 3})
    .webpackConfig((webpack) => {
        return {
            plugins: [
                new webpack.DefinePlugin({
                    __VUE_OPTIONS_API__: true,
                    __VUE_PROD_DEVTOOLS__: false,
                }),
            ],
        };

    })
    .sass('resources/sass/app.scss', 'public/css');
mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
]);
mix.options({
    hmrOptions: {
        host: 'estimate.local.com',  // site's host name
        port: 8080,
    }
});

