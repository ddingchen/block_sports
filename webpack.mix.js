const { mix } = require('laravel-mix');

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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

mix.sass('resources/assets/sass/activities/hsblockgame.scss', 'public/css/activities')
	.js('resources/assets/js/activities/hsblockgame.js', 'public/js/activities')
	.version()
	// .copy('node_modules/weui/dist/example/images', 'public/image/activities/images', false);