const elixir = require('laravel-elixir');

elixir(function(mix) {
    mix
        .copy('node_modules/admin-lte/dist/css/AdminLTE.css', 'public/assets/css/AdminLTE.css')
        .copy('node_modules/admin-lte/dist/css/skins/_all-skins.css', 'public/assets/css/_all-skins.css')
        .copy('node_modules/admin-lte/bootstrap/css/bootstrap.css', 'public/assets/css/bootstrap.css')
        .copy('node_modules/admin-lte/plugins/datepicker/datepicker3.css', 'public/assets/css/datepicker3.css')
        .sass([
            'app.scss',
        ], 'public/assets/css')
        .webpack('app.js')
        .styles([
            './public/assets/css/bootstrap.css',
            './public/assets/css/datepicker3.css',
            './public/assets/css/AdminLTE.css',
            './public/assets/css/_all-skins.css',
            './public/assets/css/app.css',
        ])
        .version([
            'public/css/all.css',
            'public/js/app.js',
        ])
    ;
});
