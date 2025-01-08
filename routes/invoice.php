<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SalePaymentsController;
use App\Http\Controllers\SalesController;
use App\Http\Middleware\confirmPassword;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::resource('invoice', InvoiceController::class);

});
