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

mix.options({
	processCssUrls: false
});

mix.js('resources/assets/js/app.js', 'public/js').minify('public/js/app.js');
mix.sass('resources/assets/sass/mdb.scss', 'public/css').minify('public/css/mdb.css');
mix.sass('resources/assets/sass/custom/styles-backend.scss', 'public/css').minify('public/css/styles-backend.css');
mix.sass('resources/assets/sass/custom/styles-frontend.scss', 'public/css').minify('public/css/styles-frontend.css');

//Minify resources JS
mix.babel('resources/assets/js/backend/scripts-backend.js', 'public/js/scripts-backend.js')
	.babel('resources/assets/js/frontend/scripts-frontend.js', 'public/js/scripts-frontend.js')
	.minify([
		'public/js/scripts-backend.js',
		'public/js/scripts-frontend.js',
	]);

//Combine modules JS
mix.babel([
	'resources/assets/js/modules/ajax.js',
	'resources/assets/js/modules/mask.js',
	'resources/assets/js/modules/modal.js',
	'resources/assets/js/modules/notify.js',
	'resources/assets/js/modules/dropzone.js',
	'resources/assets/js/modules/dropzone_crop.js',
	'resources/assets/js/modules/filter.js',
	'resources/assets/js/modules/datatables.js',
	'resources/assets/js/modules/form_actions.js'
], 'public/js/modules.js').minify('public/js/modules.js');

//Combine libs JS
mix.babel([
	'resources/assets/js/libs/*'
], 'public/js/lib.js').minify('public/js/lib.js');

// //Combine libs JS
// mix.combine([
// 	'resources/assets/js/libs/*'
// ], 'public/js/lib.js').minify('public/js/lib.js');
//



//Minify pages JS
mix.babel('resources/assets/js/pages/basic.js', 'public/js/pages/basic.js')
	.babel('resources/assets/js/pages/user.js', 'public/js/pages/user.js')
	.babel('resources/assets/js/pages/mandatory.js', 'public/js/pages/mandatory.js')
	.minify([
		'public/js/pages/basic.js',
		'public/js/pages/user.js',
		'public/js/pages/mandatory.js'
	]);