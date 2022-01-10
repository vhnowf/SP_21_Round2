<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InboxController;

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

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Feedbacks 
    Route::delete('feedbacks/destroy', 'FeedbackController@massDestroy')->name('feedbacks.massDestroy');
    Route::resource('/feedbacks','FeedbackController');

    // Inboxs
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::get('/inbox/{id}', [InboxController::class, 'show'])->name('inbox.show');

});

Route::group(['middleware' => 'auth'], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::get('/inbox/{id}', [InboxController::class, 'show'])->name('inbox.show');
    Route::get('/security', 'SecurityController@index')->name('security');
    Route::get('/service', 'ServiceController@index')->name('service');
    Route::resource('/return', 'ReturnProductController');
    Route::post('return/media', 'ReturnController@storeMedia')->name('return.storeMedia');
    Route::post('return/ckmedia', 'ReturnController@storeCKEditorImages')->name('return.storeCKEditorImages');
  //  Route::get('/return', 'ReturnProductController@index')->name('return');
    Route::get('/feedback', [FeedbackController::class,'show'])->name('feedback');
    Route::post('alert', [FeedbackController::class,'alert']);
});

Route::post('/feedback/store', [App\Http\Controllers\Api\FeedbackController::class,'alert']);
Route::get('/feedbacks', [App\Http\Controllers\Api\Admin\FeedbackController::class,'index']);
Route::post('/api/inbox/store', [App\Http\Controllers\Api\InboxController::class, 'index']);





