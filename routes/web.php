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
Route::get('create','UserCtrl@create_dua');
Route::get('/backend', function() {
 
    if (Gate::check('access.backend')) {
        return view('backend');
    }
 
    return abort(403);
 
});


Auth::routes();
Route::get('excel','ExcelCtrl@getIndex');
Route::get('excel/import','ExcelCtrl@postQueryBagianSatu');
Route::get('excel/sheets','ExcelCtrl@getSheets');
Route::get('excel/2007','ExcelCtrl@getImportExcel2007');

Route::get('/home', 'HomeController@index');
