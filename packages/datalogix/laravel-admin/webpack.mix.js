const mix = require('laravel-mix')

mix.js('resources/assets/js/app.js', 'dist/js/app.js')
    .setPublicPath('dist')
    .extract(['vue'])
    .copy('dist', '../../../public/admin')
    .disableSuccessNotifications();
