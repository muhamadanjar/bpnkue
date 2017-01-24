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
    return view('welcome');
});
Route::get('/home', 'HomeController@index');


Auth::routes();

Route::get('excel','ExcelCtrl@getIndex');
Route::post('excel/import','ExcelCtrl@postQueryBagianSatu');
Route::get('excel/sheets','ExcelCtrl@getSheets');
Route::get('excel/2007','ExcelCtrl@getImportExcel2007');


Route::group(array('prefix'=>'kuesioner'), function(){
	Route::get('/','KuesionerCtrl@getIndexVersiDua');
	Route::get('/caridata','KuesionerCtrl@getCaridata');
	Route::get('/caridata/query/{search}','KuesionerCtrl@getSearchCaridata');
	Route::get('/gambaranumum','KuesionerCtrl@getGambaranUmum');
	Route::get('/profil/{id}','KuesionerCtrl@getProfil');
	Route::get('/custom','HomeController@getJumlahKuesioner');

});

//Route::get('profile','UserCtrl@getProfil');

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

});