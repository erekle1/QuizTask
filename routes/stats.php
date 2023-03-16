<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatisticController;

Route::group(['prefix' => 'stats'], function () {
    Route::get('/', [StatisticController::class, 'index']);
    Route::put('update-answers', [StatisticController::class, 'updateAnswers']);
    Route::put('update-finished-status', [StatisticController::class, 'updateFinishedStatus']);
    Route::put('update-num-of-users', [StatisticController::class, 'updateNumOfUsers']);
});
