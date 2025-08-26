<?php


use App\Http\Controllers\Api\V1\VideoController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/videos'], function () {
    Route::get("/", [VideoController::class, 'index']);
    Route::post("/", [VideoController::class, 'store']);
    Route::get("/{id}", [VideoController::class, 'show']);
});
