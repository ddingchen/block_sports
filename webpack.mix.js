const { mix } = require('laravel-mix');
var fs = require('fs');

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

mix.js('resources/assets/js/common.js', 'public/js/common.js')
	.js('resources/assets/js/ticket/create.js', 'public/js/ticket/create.js')
	.version()

if (mix.config.inProduction) {
	mix.copy('resources/assets/img', 'public/image', false)
}

// mix.sass('resources/assets/sass/activities/hsblockgame.scss', 'public/css/activities')
// mix.js('resources/assets/js/activities/hsblockgame.js', 'public/js/activities')
//    .version()
// try {
// 	console.log('\nCheck if weui images published...')
// 	fs.statSync('public/image/activities/images')
// } catch(e) {
// 	console.log('Copy weui images to public from node_modules')
// 	mix.copy('node_modules/weui/dist/example/images', 'public/image/activities/images', false)
// }