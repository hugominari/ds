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

//Minify resources JS
mix.copy('resources/assets/js/custom.js', 'public/js/custom.js')
	.minify([
		'public/js/custom.js'
	]);

// //Modules
// mix.combine([
// 	'resources/assets/js/modules/ajax.js',
// 	'resources/assets/js/modules/mask.js',
// 	'resources/assets/js/modules/filter.js',
// 	'resources/assets/js/modules/form_actions.js'
// ], 'public/js/modules.js').minify('public/js/modules.js');
//
// //Combine layout JS
// mix.combine([
// 	'resources/assets/js/layout/material.js',
// 	'resources/assets/js/layout/ripples.js',
// 	'resources/assets/js/layout/layout.js',
// ], 'public/js/layout.js').minify('public/js/layout.js');
//
// //Combine libs JS
// mix.combine([
// 	'resources/assets/js/libs/*'
// ], 'public/js/lib.js').minify('public/js/lib.js');
//



// //Minify pages JS
// mix.copy('resources/assets/js/pages/basic.js', 'public/js/pages/basic.js')
// 	.copy('resources/assets/js/pages/provider.js', 'public/js/pages/provider.js')
// 	.copy('resources/assets/js/pages/provider-backend.js', 'public/js/pages/provider-backend.js')
// 	.copy('resources/assets/js/pages/user.js', 'public/js/pages/user.js')
// 	.copy('resources/assets/js/pages/segment.js', 'public/js/pages/segment.js')
// 	.copy('resources/assets/js/pages/promoter.js', 'public/js/pages/promoter.js')
// 	.copy('resources/assets/js/pages/logs.js', 'public/js/pages/logs.js')
// 	.copy('resources/assets/js/pages/product.js', 'public/js/pages/product.js')
// 	.copy('resources/assets/js/pages/register.js', 'public/js/pages/register.js')
// 	.minify([
// 		'public/js/pages/basic.js',
// 		'public/js/pages/provider.js',
// 		'public/js/pages/provider-backend.js',
// 		'public/js/pages/user.js',
// 		'public/js/pages/promoter.js',
// 		'public/js/pages/segment.js',
// 		'public/js/pages/logs.js',
// 		'public/js/pages/product.js',
// 		'public/js/pages/register.js'
// 	]);

/**
 * CSS
 */

//Compile SCSS


// //Combine layout CSS
// mix.styles([
// 	'resources/assets/css/AdminLTE.css',
// 	'resources/assets/css/bootstrap-material-design.css',
// 	'resources/assets/css/ripples.css',
// 	'resources/assets/css/MaterialAdminLTE.css'
// ], 'public/css/admin-style.css')
// 	.minify('public/css/admin-style.css');