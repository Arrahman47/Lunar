<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;

Route::post('/purchase/{id}', [PurchaseController::class, 'buy']);
