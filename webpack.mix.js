let mix = require('laravel-mix');

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

/* mix.js('resources/assets/js/app.js', 'public/js')
    .extract(['tether',
            'jquery',
            'jquery-ui',
            'jquery-smooth-scroll',
            'jquery-browserify',
            'jquery-mask-plugin',
            'bootstrap-switch',
            'bootstrap-slider'])
    .autoload({
        jquery: ['$', 'jQuery', 'jquery'],
        tether: ['window.Tether', 'Tether']
    })
    .sass('resources/assets/sass/app.scss', 'public/css/app.css')
    .styles(['node_modules/bootstrap-slider/dist/css/bootstrap-slider.min.css',
            'node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css'
    ], 'public/css/other.css');  */

mix.js('resources/assets/js/app.js', 'public/js')
    .extract([
        'vue',
        'tether',
        'jquery',
        //'jquery-ui',
        //'jquery-smooth-scroll',
        //'jquery-browserify',
        'jquery-mask-plugin',
        //'bootstrap-switch',
        'bootstrap-toggle',
        //'bootstrap-slider',
        'bootstrap-select',
        'eonasdan-bootstrap-datetimepicker'
        /* 'emodal' */
    ])
    .autoload({
        jquery: ['$', 'jQuery', 'jquery'],
        tether: ['window.Tether', 'Tether']
    })
    .sass('resources/assets/sass/app.scss', 'public/css/app.css')
    .styles([
        //'node_modules/bootstrap-slider/dist/css/bootstrap-slider.min.css',
        //'node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
        'node_modules/bootstrap-select/dist/css/bootstrap-select.min.css',
        //'node_modules/ajax-bootstrap-select/dist/css/ajax-bootstrap-select.min.css',
        'node_modules/bootstrap-toggle/css/bootstrap2-toggle.css',
        'node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
    ], 'public/css/other.css'); 

mix.js([
        //'node_modules/ajax-bootstrap-select/dist/js/ajax-bootstrap-select.min.js',
        'node_modules/bootstrap-select/dist/js/i18n/defaults-pt_BR.min.js'
    ], 'public/js/other.js'); 

mix.js('resources/assets/js/entradaestoque.js', 'public/js');
mix.js('resources/assets/js/inventarioestoque.js', 'public/js');

/* mix.styles([
        'node_modules/ajax-bootstrap-select/dist/css/ajax-bootstrap-select.min.css'
    ], 'public/css/custom.css'); */