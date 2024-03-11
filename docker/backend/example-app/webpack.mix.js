const mix = require('laravel-mix');

const  CaseSensitivePathsPlugin = require('case-sensitive-paths-webpack-plugin');
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')

const  webpackConfig = {
    plugins: [
        new VuetifyLoaderPlugin(),
        new CaseSensitivePathsPlugin()
        // other plugins ...
    ]
    // other webpack config ...
}

mix.webpackConfig(webpackConfig);

mix.js('resources/js/app.js', 'public/js').vue();

