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

mix.sass('resources/assets/sass/activities/hsblockgame.scss', 'public/css/activities')
	.js('resources/assets/js/activities/hsblockgame.js', 'public/js/activities')
	.version()

try {
	console.log('\nCheck if weui images published...')
	fs.statSync('public/image/activities/images')
} catch(e) {
	console.log('Copy weui images to public from node_modules')
	mix.copy('node_modules/weui/dist/example/images', 'public/image/activities/images', false)
}