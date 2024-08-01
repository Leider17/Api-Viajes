<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HotelController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/Destinations',[DestinationController::class,'index'])->name('destinations.index');
Route::get('Destinations/{destination}',[DestinationController::class,'show'])->name('destinations.show');
Route::get('/DestinationsComments',[DestinationController::class,'DestinationsComments'])->name('destinationscomments.index');
Route::get('/DestinationsComments/{destination}',[DestinationController::class,'DestinationComments'])->name('destinationscomments.show');
Route::get('/DestinationsHotels',[DestinationController::class,'DestinationsHotels'])->name('destinationshotels.index');
Route::get('/DestinationsHotels/{destination}',[DestinationController::class,'DestinationHotels'])->name('destinationshotels.show');


