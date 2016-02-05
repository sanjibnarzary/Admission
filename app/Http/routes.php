<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/**
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function () {
    //
    Route::get('/', 'PageController@index');
    Route::get('/credits', 'PageController@credits');

    Route::get('/admin/page/create','PageController@createPageForm');
    Route::post('/admin/page/create','PageController@createPage');

    Route::get('/admin/page/{pageId}',['uses'=>'PageController@updatePageForm']);
    Route::post('/admin/page/{pageId}',['uses'=>'PageController@updatePage']);

    Route::get('/application','ApplicationController@index');
    Route::get('/application/edit','ApplicationController@edit');
    Route::get('/application/preview','ApplicationController@preview');

    Route::post('/application','ApplicationController@save');
    Route::post('/application/edit','ApplicationController@update');

    Route::get('/application/photo','ApplicationPhotoController@index');
    Route::post('/application/photo','ApplicationPhotoController@savePhoto');
    Route::get('/application/photo/preview','ApplicationPhotoController@previewPhoto');
    Route::get('/application/photo/edit','ApplicationPhotoController@editPhoto');
    Route::get('/application/preview/whole','ApplicationController@previewWhole');

    Route::get('/application/payment','ApplicationPaymentController@paymentProcess');

// Authentication routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', ['middleware'=>'auth','uses'=>'Auth\AuthController@getLogout']);

// Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

    //Mobile Activation
    Route::get('/auth/activate/{appId}/mobile/{mobileCode}',['uses'=>'Auth\AuthController@mobileActivate']);
    Route::post('/auth/activate/mobile',['uses'=>'Auth\AuthController@postMobileActivate']);
    Route::get('/auth/activate/mobile/resend',['uses'=>'Auth\AuthController@mobileCodeResend']);

    //Email Activation
    Route::get('/auth/activate/{appId}/email/{emailCode}',['uses'=>'Auth\AuthController@emailActivate']);
    Route::post('/auth/activate/email',['uses'=>'Auth\AuthController@postEmailActivate']);
    Route::get('/auth/activate/email/resend',['uses'=>'Auth\AuthController@emailCodeResend']);
    //Dashboard route
    Route::get('dashboard','DashboardController@index');
    Route::get('map','DashboardController@test');
 });


