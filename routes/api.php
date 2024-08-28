<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sactum')->group(function () {
    Route::post('/Destinations', [DestinationController::class, 'store'])->name('destinations.store');
    Route::put('/Destinations/{destination}', [DestinationController::class, 'update'])->name('destinations.update');
    Route::delete('/Destinations/{destination}', [DestinationController::class, 'destroy'])->name('destinations.destroy');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

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

Route::get('/Destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/Destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/DestinationsComments', [DestinationController::class, 'DestinationsComments'])->name('destinationscomments.index');
Route::get('/DestinationsComments/{destination}', [DestinationController::class, 'DestinationComments'])->name('destinationscomments.show');
Route::get('/DestinationsHotels', [DestinationController::class, 'DestinationsHotels'])->name('destinationshotels.index');
Route::get('/DestinationsHotels/{destination}', [DestinationController::class, 'DestinationHotels'])->name('destinationshotels.show');
Route::get('/DestinationsActivities', [DestinationController::class, 'DestinationsActivities'])->name('destinationsactivities.index');
Route::get('/DestinationsActivities/{destination}', [DestinationController::class, 'DestinationActivities'])->name('destinationsactivities.show');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/reservations', [UserController::class, 'userReservations'])->name('users.reservations');

Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('comments.show');

Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
