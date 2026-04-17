<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\RedirectIfAuthenticatedCustom;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/',[AuthController::class, 'showLogin'])->name('showlogin')->middleware(RedirectIfAuthenticatedCustom::class);
Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/register',[AuthController::class,'showRegister'])->name('showRegister');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::get('/regisgter/fail',[AuthController::class,'registerSuccess'])->name('registerFail');
Route::get('/contact',[ContactController::class,'showContact'])->name('contact.show');
Route::post('/contact',[ContactController::class,'contact'])->name('contact');
Route::get('/contact/success',[ContactController::class,'contactSuccess'])->name('contact.success');
Route::get('/contact/fail',[ContactController::class,'contactFail'])->name('contact.fail');

Route::middleware([Authenticate::class])->group(function(){
Route::get('/post',[PostController::class,'showPost'])->name('showPost');
Route::post('/post',[PostController::class,'post'])->name('post');
Route::delete('/post/{post}',[PostController::class,'delete'])->name('delete');
Route::get('/post/success',[PostController::class,'postSuccess'])->name('post.success');
Route::get('post/fail',[PostController::class,'postFail'])->name('post.fail');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::get('/city',[CityController::class,'getCities'])->name('getCities');
});

?>