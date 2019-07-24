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
    // if (Auth::check()) {
    //     // The user is logged in...
    //     return redirect()->intended('/home');
        
    // }else{
        return view('auth.login'); 
    
});






Auth::routes();

Route::get('/home', 'DashboardController@index')->name('home');

Route::get('/Eventos','DashboardController@calendarEvent')->name('Eventos');

Route::get('getEvento','DashboardController@getEventos');
// Route::get('/dashboard/v2', 'DashboardController@versiontwo')->name('v2');
// Route::get('/dashboard/v3', 'DashboardController@versionthree')->name('v3');
Route::get('getData','EventosController@getDataEventos');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('addEventos','EventosController@AddEventos');
Route::get('/calendario','CalendarController@index');
Route::get('evento','EventosController@showEvento');

Route::group(['middleware' => 'cors'], function(){
    //Bandeja
    Route::get('bandeja','EventosController@showBandeja');
    Route::get('getDataR','EventosController@getResponsables');
    Route::get('editMensaje/{id}','EventosController@edit');
    Route::get('chat/{id}','EventosController@chat');
    Route::get('searchEvento/{id}','EventosController@searchEvento');
    Route::get('getDataRes','EventosController@getDataResponsable');
    //--------------------

    //----Mensajes------
    Route::get('getChat/{id}','EventosController@getMessages');
    Route::post('addMessages','EventosController@addMessageData');

    Route::post('upload','UploadController@store');
    Route::post('Uploadfile','EventosController@uploadfile');
    //------------------

}); 