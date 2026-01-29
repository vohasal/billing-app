<?php

use App\Http\Controllers\Api\v1\AccountController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CurrencyController;
use App\Http\Controllers\Api\v1\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function (){
    Route::apiResource("categories", CategoryController::class);
    Route::apiResource("currencies", CurrencyController::class);
    Route::apiResource("accounts", AccountController::class);
    Route::apiResource("transactions", TransactionController::class);
});
