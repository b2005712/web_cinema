<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\UserController;


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

// Test
Route::get('/admin', [MainController::class, 'admin']);


Route::get('/', [MainController::class, 'home']);

Route::get('/home', [MainController::class, 'home']);

Route::get('/movie/{id}', [MainController::class, 'movieDetails']);

Route::get('/news', [MainController::class, 'news']);

Route::get('/contact', [MainController::class, 'contact']);

Route::get('/login', [MainController::class, 'login']);

Route::get('/register', [MainController::class, 'register']);

Route::post('/signIn', [AuthController::class, 'signIn']);

Route::post('/signUp', [AuthController::class, 'signUp']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/movies', [MainController::class, 'movies']);

Route::get('/movies/filter', [MainController::class, 'movieFilter']);

Route::get('/theater', [MainController::class, 'theater']);

Route::get('/ticket/{schedule_id}', [MainController::class, 'ticket']);

Route::post('/ticketCreate', [MainController::class, 'createTicket']);

Route::get('/ticketPaid/{ticket_id}', [MainController::class, 'ticketPaid']);

Route::get('/paymentQR/{ticket_id}', [MainController::class, 'paymentQR']);

Route::get('/paymentATM/{ticket_id}', [MainController::class, 'paymentATM']);

Route::get('/search', [MainController::class, 'search']);

Route::get('/profile',[MainController::class,'profile']);