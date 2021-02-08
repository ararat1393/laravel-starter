<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/**
 * load laravel mix
 */
Route::get('/app/{any?}', function (){
    return view('app');
})->where('any', '.*');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers'],function(){

    Route::group(['namespace' => 'Resource'],function(){
        Route::resource('photo','PhotoController')->except(['update']);
        Route::post('photo/{photo}','PhotoController@update')->name('photo.update');
    });

    Route::group(['prefix' => 'ajax'],function(){
        Route::match(['post','get'],'/users','AjaxController@users');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
