<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\EventController;

Route::get('/shows', [ShowController::class, 'index'])->name('api.shows.index');
Route::get('/shows/{showId}/', [ShowController::class, 'show'])->name('api.shows.show');
Route::get('/events/{eventId}/', [EventController::class, 'show'])->name('api.events.show');
Route::post('/events/{eventId}/', [EventController::class, 'reserve'])->name('api.events.reserve');
