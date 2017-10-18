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

/*Route::get('/', function (){
    return view('welcome');
});*/


Route::group(['middleware' => 'admin'], function () {

//--------------------create and update news-----------------
    Route::post('/news','NewsController@store');
    Route::get('/news/create', 'NewsController@create');
    Route::get('/news/{id}/edit','NewsController@edit');
    Route::PUT('/news/{id}','NewsController@update');
    Route::DELETE('/news/{id}','NewsController@destroy');
    
//--------------------create and update Galleries-----------------
    
    Route::get('/admin/create','GalleriesController@create');
    Route::post('/admin/store','GalleriesController@store');
    Route::get('/admin/edit/{id}','GalleriesController@edit');
    Route::post('/admin/galleries_update/{id}','GalleriesController@update');
    Route::post('/admin/deleteGalleries','GalleriesController@destroy');
    
//--------------------create and update image-----------------
    
    Route::get('/admin/imageCreate','ImagesController@create');
    Route::post('/admin/imageStore','ImagesController@store');
    Route::get('/admin/show','ImagesController@show');
    Route::post('/admin/update','ImagesController@update');
    Route::DELETE('/admin/images/{id}','ImagesController@destroy');

    //--------------------request-clients-----------------

    Route::get('/admin/request-clients','CallController@index');
    Route::get('/admin/request-clients/{id}','CallController@show');
//Route::get('/admin/request-clients/{id}/edit','CallController@edit');
    Route::PUT('/admin/request-clients/{id}','CallController@update');
    Route::DELETE('/admin/request-clients/{id}','CallController@destroy');
});


Route::get('/','NewsController@index');
Route::get('/news/{alias}','NewsController@show');



//-------------------------------------------------------------

Route::get('/admin','GalleriesController@index');

Route::get('/home', 'GalleriesController@index');
Route::get('/galleries', 'GalleriesController@index')->name('home');
Route::get('/galleries/{alias}', 'GalleriesController@show');

Route::get('/login','SessionController@create');
Route::post('/login','SessionController@store');
Route::get('/register','RegistrationController@create');
Route::post('/register','RegistrationController@store');
Route::get('/logout','SessionController@destroy');

//контроллер вызова мастера 
Route::post('/application','CallController@store');
Route::get('/admin/count-new-message','CallController@newMessage');



