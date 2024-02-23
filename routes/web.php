<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

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

require 'admin.php';

Route::get('/admin', [MainController::class, 'admin']);

Route::get('/admin_movie', [MainController::class, 'admin_movie']);

Route::get('/', [MainController::class, 'home']);

Route::get('/home', [MainController::class, 'home']);

Route::get('/news', [MainController::class, 'news']);

Route::get('/contact', [MainController::class, 'contact']);

Route::get('/login', [MainController::class, 'login']);

Route::post('/signIn', [AuthController::class, 'signIn']);

Route::get('/register', [MainController::class, 'register']);

Route::post('/signUp', [AuthController::class, 'signUp']);

Route::get('/movies', [MainController::class, 'movies']);

Route::get('/movieDetails', [MainController::class, 'movieDetails']);

Route::get('/theater', [MainController::class, 'theater']);

Route::get('/ticket', [MainController::class, 'ticket']);

// Route::post('/register_user', [MainController::class, 'registerUser'])->name('register_user');

// Route::post('/login_user', [MainController::class, 'loginUser'])->name('login_user');

Route::get('/home_page', [MainController::class, 'homePage']);

Route::get('/logout', [MainController::class, 'logout']);

Route::get('/contact_user', [MainController::class, 'contactUser']);

Route::get('/product_details/{product_id}', [Product::class, 'detail']);

Route::get('/product_home', [MainController::class, 'productHome']);

Route::post('/search', [MainController::class, 'search']);
