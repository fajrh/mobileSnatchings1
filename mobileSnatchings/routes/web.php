<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddMapPinController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/addpin', function () {
    return view('addloc');
});

Route::get('/my', [AddMapPinController::class, 'index'])->name('my.index');
Route::get('/addthepin', [AddMapPinController::class, 'store'])->name('addthepin');

Route::get('/locations', [AddMapPinController::class, 'show'])->name('locations.show');

Route::options('/{any}', function () {
    return response()->json([], 200);
})->where('any', '.*');