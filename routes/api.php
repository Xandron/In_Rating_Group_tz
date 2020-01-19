<?php

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;


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

Route::prefix('/')->group(function () {
    //Task №6,6.1,6,2
    Route::get('users/{posts_limit?}','UserController@index');


    //Task №7
    Route::get('comments/{user_id}/sql','CommentController@getCommentsSql')->where(['user_id' => '[0-9]+']);
    //Task №7.1
    Route::get('comments/{user_id}/qb','CommentController@getCommentsQB')->where(['user_id' => '[0-9]+']);
});

