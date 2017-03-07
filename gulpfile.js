const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
	//scripts == Combine scripts
    mix.sass('app.scss')
    	.sass('map.scss')
       	.webpack('app.js')
       	//.webpack('map-editor.js');
    	.scripts(
	    	['map-editor.js','ajax.js'],
	    	'public/js/map/map-editor.js')
      .scripts(
  	    ['geolocation.js'],
  	    'public/js/map/map.js');
});
