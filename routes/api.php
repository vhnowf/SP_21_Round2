<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/feedback/store', [App\Http\Controllers\Api\FeedbackController::class,'alert']);
Route::get('/feedbacks', [App\Http\Controllers\Api\Admin\FeedbackController::class,'index']);
Route::post('/api/inbox/store', [App\Http\Controllers\Api\InboxController::class, 'index']);
Route::get('/feedbacks/{id}', [App\Http\Controllers\Api\Admin\FeedbackController::class,'show']);
Route::get('feedbacks/{id}/delete',[App\Http\Controllers\Api\Admin\FeedbackController::class,'destroy']);
