const mix = require('laravel-mix')

mix.js('resources/js/app.js', 'dist/js/app.js')
    .sass('resources/sass/app.scss', 'dist/css/app.css')
    .sass('resources/sass/auth.scss', 'dist/css/auth.css')
    .setPublicPath('dist')
    .extract(['vue'])
    .copy('dist', '../../../public/admin')
    .disableSuccessNotifications();
