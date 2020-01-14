const mix = require('laravel-mix')

// admin mix
mix.styles([
    'resources/admin/main.css',
    'node_modules/admin-lte/dist/css/adminlte.min.css',
], 'public/admin/css/main.css')

mix.scripts([
    'node_modules/admin-lte/plugins/jquery/jquery.min.js',
    'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'node_modules/admin-lte/dist/js/adminlte.min.js',
], 'public/admin/js/main.js')

mix.copy('node_modules/pace-js/themes/blue/pace-theme-minimal.css', 'public/admin/css/pace.css')
mix.copy('node_modules/pace-js/pace.min.js', 'public/admin/js/pace.js')

mix.copy('node_modules/admin-lte/dist/img', 'public/admin/img')
mix.copy('node_modules/admin-lte/plugins', 'public/admin/plugins')

//frontend mix
mix.styles([
    'resources/frontend/assets/css/custom.css',
    'resources/frontend/assets/css/main.css',
], 'public/assets/css/main.css')

mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/bs-custom-file-input/dist/bs-custom-file-input.min.js',
    'resources/frontend/assets/js/main.js',
], 'public/assets/js/main.js')

mix.copy('resources/frontend/assets/img', 'public/assets/img')

mix.copy('node_modules/@fortawesome/fontawesome-free/css', 'public/assets/vendor/fontawesome/css')
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/assets/vendor/fontawesome/webfonts')


