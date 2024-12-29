<?php

use App\Http\Controllers\ProductionController;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::resource('productions', ProductionController::class);

    Route::get("production/delete/{id}", [ProductionController::class, 'destroy'])->name('production.delete')->middleware(confirmPassword::class);

});
