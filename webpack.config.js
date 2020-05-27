const path = require('path')

module.exports = {
    output: {chunkFilename: 'assets/js/chunks/[name].js?id=[chunkhash]'},
    resolve: {
        alias: {
            ziggy: path.resolve('vendor/tightenco/ziggy/dist/js/route.js'),
            '~': path.resolve('resources/js/')
        },
    },
    module: {
        rules: [
            {
                test: /resources[\\\/]lang.+\.(php|json)$/,
                loader: 'laravel-localization-loader',
            }
        ]
    }
}
