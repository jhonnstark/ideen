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

mix.js('resources/js/app.js', 'public/js')
    .sourceMaps()
    .extract(['vue'])
    .copyDirectory('resources/img', 'public/img')
    .sass('resources/sass/app.scss', 'public/css')
    .browserSync({
        open: 'external',
        host: 'localhost',
        proxy: 'localhost',
        files: [
            'resources/views/**/*.php',
            'app/**/*.php', 'routes/**/*.php',
            'public/js/*.js',
            'resources/js/components/*.vue',
            'public/css/*.css'
        ]
    });

if (mix.inProduction()) {
    mix.version();
}
