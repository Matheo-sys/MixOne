let mix = require('laravel-mix');

mix.js('resources/js/main.js', 'public/js')
    .sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');
