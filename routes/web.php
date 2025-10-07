<?php

use App\Models\Wiraniaga;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WiraniagaController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('guest')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    //Data Wiraniaga
    Route::get('/wiraniaga', [WiraniagaController::class, 'index'])->name('wiraniaga.index');
    Route::post('/wiraniaga-add', [WiraniagaController::class, 'store'])->name('wiraniaga.store');
    Route::get('/wiraniaga-destroy/{id}', [WiraniagaController::class, 'destroy']);
    Route::get('/wiraniaga-show/{id}', [WiraniagaController::class, 'show'])->name('wiraniaga.show');
});
