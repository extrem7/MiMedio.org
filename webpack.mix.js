const mix = require('laravel-mix')
const config = require('./webpack.config')
mix.webpackConfig(config)

const options = {
    processCssUrls: false,
    terser: {
        extractComments: false,
    }
}
mix.options(options)

// admin mix
mix.sass('resources/admin/main.scss', 'public/admin/css/main.css')

mix.scripts([
    'node_modules/admin-lte/plugins/jquery/jquery.min.js',
    'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'node_modules/admin-lte/dist/js/adminlte.min.js',
], 'public/admin/js/main.js')

mix.copy('node_modules/pace-js/themes/blue/pace-theme-minimal.css', 'public/admin/css/pace.css')
    .copy('node_modules/pace-js/pace.min.js', 'public/admin/js/pace.js')
    .copyDirectory('node_modules/admin-lte/dist/img', 'public/admin/img')
    //.copyDirectory('node_modules/admin-lte/plugins', 'public/admin/plugins')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/admin/webfonts')

//frontend mix

mix.sass('resources/sass/app.scss', 'public/assets/css/')
    .sass('resources/frontend/scss/main.scss', 'public/assets/css/')

mix.js('resources/js/app.js', 'public/assets/js/').vue()

mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/bs-custom-file-input/dist/bs-custom-file-input.min.js',
    'node_modules/jquery-mousewheel/jquery.mousewheel.js',
    'resources/frontend/js/main.js',
    'resources/frontend/js/custom.js',
], 'public/assets/js/main.js')

mix.copyDirectory('resources/frontend/img', 'public/assets/img')
    .copyDirectory('node_modules/tinymce/', 'public/assets/vendor/tinymce')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/assets/webfonts')

mix.sourceMaps()
    .version()
    .disableSuccessNotifications()
