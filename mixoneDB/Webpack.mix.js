let mix = require('laravel-mix');

mix.js('resources/js/main.js', 'public/js')
    .js('resources/js/bootstrap-maps-mock.js', 'public/js')
    .js('resources/js/pages/contact/contactForm.js', 'public/js/pages/contact')
    .js('resources/js/pages/studio_list/map.js', 'public/js/pages/studio_list')
    .js('resources/js/pages/studio_list/ourStudios.js', 'public/js/pages/studio_list')
    .js('resources/js/pages/studio/reservation.js', 'public/js/pages/studio')
    .js('resources/js/components/cookie-banner.js', 'public/js/components')
    .js('resources/js/components/message-widget.js', 'public/js/components')
    .js('resources/js/pages/home/search.js', 'public/js/pages/home')
    .js('resources/js/dashboard/studio/dashboard.js', 'public/js/dashboard/studio')
    .sass('resources/sass/main.scss', 'public/css/main-compiled.css')
    .sass('resources/sass/app.scss', 'public/css');
