<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\UserController;



Route::post('/login',[UserController::class,'loginUser'])->name('login');
Route::post('/register', [UserController::class, 'createUser'])->name('users.register');
    
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
    Route::delete('/destinations/{destination}', [DestinationController::class, 'destroy'])->name('destinations.destroy');
    Route::put('/destinations/{destination}', [DestinationController::class, 'update'])->name('destinations.update');



    Route::post('/hotels', [HotelController::class, 'store'])->name('hotels.store');
    Route::put('/hotels/{hotel}', [HotelController::class, 'update'])->name('hotels.update');
    Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy'])->name('hotels.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
    Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
    Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
});

Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/destinations/comments', [DestinationController::class, 'DestinationsComments'])->name('destinationscomments.index');
Route::get('/destinations/{destination}/comments', [DestinationController::class, 'DestinationComments'])->name('destinationscomments.show');
Route::get('/destinations/Hotels', [DestinationController::class, 'DestinationsHotels'])->name('destinationshotels.index');
Route::get('/destinations/{destination}/hotels', [DestinationController::class, 'DestinationHotels'])->name('destinationshotels.show');
Route::get('/destinations/Activities', [DestinationController::class, 'DestinationsActivities'])->name('destinationsactivities.index');
Route::get('/destinations/{destination}/activities', [DestinationController::class, 'DestinationActivities'])->name('destinationsactivities.show');


Route::get('/users/{user}/reservations', [UserController::class, 'userReservations'])->name('users.reservations');

Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('comments.show');

Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
