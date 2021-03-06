<?php

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

// Homepage
Route::get('/', 'TopicsController@index')
     ->name('root');

// 用戶身分驗證相關路由
Route::get('login', 'Auth\LoginController@showLoginForm')
     ->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')
     ->name('logout');

// 用戶註冊相關路由
Route::get('register', 'Auth\RegisterController@showRegistrationForm')
     ->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 密碼重置相關路由
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
     ->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
     ->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
     ->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')
     ->name('password.update');

// Email 認證相關路由
Route::get('email/verify', 'Auth\VerificationController@show')
     ->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')
     ->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')
     ->name('verification.resend');

// 使用者資源路由
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

// 話題資源路由
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')
     ->name('topics.show');

// 分類資源路由
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

// 上傳圖片路由
Route::post('upload_image', 'TopicsController@uploadImage')
     ->name('topics.upload_image');

// 回覆資源路由
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

// 通知資源路由
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

//
Route::get('permission-denied', 'PagesController@permissionDenied')
     ->name('permission-denied');