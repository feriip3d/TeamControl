let mix = require('laravel-mix');

mix.setPublicPath('public')
    .js('resources/js/app.js', 'js')
    .sass('resources/sass/login.sass', 'css')
    .sass('resources/sass/app.sass', 'css');