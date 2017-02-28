<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('admin/login');
});
Route::get('/home', 'HomeController@index');


Auth::routes();
Route::group(array('prefix'=>'admin'), function(){
	Route::get('login','AuthCtrl@showLoginForm');
	Route::post('login','AuthCtrl@login');
	Route::get('logout','AuthCtrl@logout');
});

Route::get('excel','ExcelCtrl@getIndex');
Route::post('excel/import','ExcelCtrl@postQueryBagianSatu');
Route::get('excel/sheets','ExcelCtrl@getSheets');
Route::get('excel/2007','ExcelCtrl@getImportExcel2007');

Route::group(array('prefix'=>'map'), function(){
	Route::get('/','MapCtrl@getIndex');
});
Route::group(array('prefix'=>'layers'), function(){
	Route::get('/','LayerCtrl@getIndex');
	Route::get('/tambah','LayerCtrl@getTambah');
	Route::post('/addedit','LayerCtrl@postTambah');
	Route::get('/ubah/{id}','LayerCtrl@getUbah');
	Route::get('/hapus/{id}','LayerCtrl@getHapus');
	Route::get('/custom','LayerCtrl@custom');
	Route::get('/layerinfo/{id}','LayerCtrl@getLayerinfo');
	Route::get('/layerinfopopup/{id}/{idx}/{layern}','LayerCtrl@getLayerinfopopup');
	Route::post('/layerinfopopup/{id}/{idx}/{layern}','LayerCtrl@postLayerinfopopup');
	Route::get('/layeresrihapus/{id}','LayerCtrl@getLayeresrihapus');
	
	
	

});

Route::get('profile','UserCtrl@getProfil');

Route::group(array('prefix'=>'admin'), function(){
	Route::get('statistik','WebCtrl@getStatistiklist');
});
Route::group(array('prefix'=>'pengaturan'), function(){
	Route::get('user','UserCtrl@getIndex');
	Route::get('user/tambah','UserCtrl@getTambah');
	Route::post('user/post','UserCtrl@postAddEdit');
	Route::get('user/edit/{$id}','UserCtrl@getUbah');
	Route::get('user/hapus/{$id}','UserCtrl@postHapus');
	Route::get('user/aktif/{$id}','UserCtrl@getAktifnonaktif');

	Route::get('role','RoleCtrl@getIndex');

});

Route::group(array('prefix'=>'api'), function(){
	Route::get('fasilitas',['middleware' => 'cors','uses' => 'WebAppsCtrl@getFasilitas']);
	Route::get('poi',['middleware' => 'cors','uses' => 'WebAppsCtrl@getPoiPandeglang']);
	Route::get('searchfasilitas/{key}',['middleware' => 'cors','uses' => 'WebAppsCtrl@getSearchFasilitas']);
	
	Route::get('map/getmarker',['middleware' => 'cors',function (){
		return \DB::table('fasilitas')->get();
	}]);

	//Login
	Route::post('login','WebAppsCtrl@login');

	//Jaringan Jalan Fungsi
	Route::get('jjfungsi',[
		'nocsrf' => true,
		'middleware' => 'cors',
		'as'=>'jjpan.jjfungsi',
		'uses'=>'WebAppsCtrl@getJaringanFungsi'
	]);

	Route::post('jjfungsi/insert',[
		'nocsrf' => true,
		'middleware' => 'cors',
		'as'=>'jjpan.jjfungsi.insert',
		'uses'=>'WebAppsCtrl@postJaringanFungsi'
	]);
	Route::post('jjfungsi/edit/{id}',[
		'nocsrf' => true,
		'middleware' => 'cors',
		'as'=>'jjpan.jjfungsi.edit',
		'uses'=>'WebAppsCtrl@postUpdateJaringanFungsi'
	]);
	Route::get('jjfungsi/delete/{id}',[
		'nocsrf' => true,
		'middleware' => 'cors',
		'as'=>'jjpan.jjfungsi.hapus',
		'uses'=>'WebAppsCtrl@postDeleteJaringanFungsi'
	]);

	Route::post('jjfungsi/editmap/{id}',[
		'nocsrf' => true,
		'middleware' => 'cors',
		'as'=>'jjpan.jjfungsi.editmap',
		'uses'=>'WebAppsCtrl@postUpdateJaringanFungsiMap'
	]);
	
});