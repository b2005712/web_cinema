<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CastController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieGenresController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'home']);
    Route::get('/logout', [AdminController::class, 'home']);
    //TODO Movie Genres
    Route::prefix('movie_genres')->group(function () {
        Route::get('/', [MovieGenresController::class, 'movie_genres']);
        Route::post('/create', [MovieGenresController::class, 'postCreate']);
        Route::post('/edit/{id}', [MovieGenresController::class, 'postEdit']);
        Route::delete('/delete/{id}', [MovieGenresController::class, 'delete']);
        Route::get('/status', [MovieGenresController::class, 'status']);
    });

    //TODO Movie
    Route::prefix('movie')->group(function () {
        Route::get('/', [MovieController::class, 'movie']);
        Route::get('/create', [MovieController::class, 'getCreate']);
        Route::post('/create', [MovieController::class, 'postCreate']);
        Route::get('/edit/{id}', [MovieController::class, 'getEdit']);
        Route::post('/edit/{id}', [MovieController::class, 'postEdit']);
        Route::delete('/delete/{id}', [MovieController::class, 'delete']);
        Route::get('/status', [MovieController::class, 'status']);
        Route::get('/search', [MovieController::class, 'searchMovie']);
    });

    //TODO Room
    Route::prefix('room')->group(function () {
        Route::get('/delete/{id}', [RoomController::class, 'delete']);
        Route::post('/create', [RoomController::class, 'postCreate']);
        Route::post('/edit/{id}', [RoomController::class, 'postEdit']);
        Route::get('/status', [RoomController::class, 'status']);
        Route::get('/', [RoomController::class, 'room']);
    });

    //TODO Seat
    Route::prefix('seat')->group(function () {
        Route::get('/{id}', [SeatController::class, 'seats']);
        Route::post('/create', [SeatController::class, 'postCreate']);
        Route::post('/edit', [SeatController::class, 'postEdit']);
        Route::get('/on/{id},{room_id}', [SeatController::class, 'on']);
        Route::get('/off/{id},{room_id}', [SeatController::class, 'off']);
        Route::post('/row', [SeatController::class, 'postEditRow']);
        Route::get('/delete/{id}', [SeatController::class, 'delete']);
    });

    //TODO Theater
    Route::prefix('theater')->group(function () {
        Route::get('/', [TheaterController::class, 'theater']);
        Route::post('/create', [TheaterController::class, 'postCreate']);
        Route::post('/edit/{id}', [TheaterController::class, 'postEdit']);
        Route::get('/status', [TheaterController::class, 'status']);
        Route::delete('/delete/{id}', [TheaterController::class, 'delete']);
    });

    //TODO Schedule
    Route::prefix('schedule')->group(function () {
        Route::get('/', [SchedulesController::class, 'schedule']);
        Route::post('/create', [SchedulesController::class, 'postCreate']);
        Route::post('/edit', [SchedulesController::class, 'postEdit']);
        Route::get('/status', [SchedulesController::class, 'status']);
        Route::get('/early_status', [SchedulesController::class, 'early_status']);
        //        Route::delete('/delete/{id}', [SchedulesController::class, 'delete']);
        Route::get('/deleteall', [SchedulesController::class, 'deleteAll']);
    });

    //TODO Events
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'events']);
        Route::post('/create', [EventController::class, 'postCreate']);
        Route::post('/edit/{id}', [EventController::class, 'postEdit']);
        Route::delete('/delete/{id}', [EventController::class, 'delete']);
        Route::get('/status', [EventController::class, 'status']);
    });
    //TODO Discount
    Route::prefix('discount')->group(function () {
        Route::get('/', [DiscountController::class, 'discount']);
        Route::post('/create', [DiscountController::class, 'postCreate']);
        Route::post('/edit/{id}', [DiscountController::class, 'postEdit']);
        Route::get('/status', [DiscountController::class, 'status']);
        Route::delete('/delete/{id}', [DiscountController::class, 'delete']);
    });
    //TODO Book_Ticket
    Route::prefix('ticket')->group(function () {
        Route::get('/', [TicketController::class, 'ticket']);
    });

    //TODO Food/Topping
    Route::prefix('food')->group(function () {
        Route::get('/', [FoodController::class, 'food']);
        Route::post('/create', [FoodController::class, 'postCreate']);
        Route::post('/edit/{id}', [FoodController::class, 'postEdit']);
        Route::delete('/delete/{id}', [FoodController::class, 'delete']);
        Route::get('/status', [FoodController::class, 'status']);
    });

    //TODO user_account
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'user']);
        Route::get('/status', [UserController::class, 'status']);
        Route::get('/search', [UserController::class, 'searchUser']);
        Route::delete('/delete/{id}', [UserController::class, 'delete']);
    });

    //TODO banners


    //TODO Cast
    Route::prefix('cast')->group(function () {
        Route::get('/', [CastController::class, 'cast']);
        Route::post('/create', [CastController::class, 'postCreate']);
        Route::post('/edit/{id}', [CastController::class, 'postEdit']);
        Route::delete('/delete/{id}', [CastController::class, 'delete']);
    });

    //TODO Combo
    Route::prefix('combo')->group(function () {
        Route::get('/', [ComboController::class, 'combo']);
        Route::post('/create', [ComboController::class, 'postCreate']);
        Route::post('/edit/{id}', [ComboController::class, 'postEdit']);
        Route::get('/status', [ComboController::class, 'status']);
        Route::delete('/delete/{id}', [ComboController::class, 'delete']);
    });

    //TODO Prices
    Route::prefix('prices')->group(function () {
        Route::get('/', [TicketController::class, 'price']);
        Route::post('/edit', [TicketController::class, 'edit']);
    });

    //TODO Info
    Route::prefix('info')->group(function () {
        Route::get('/', [AdminController::class, 'info']);
        Route::post('/', [AdminController::class, 'postInfo']);
    });
});
