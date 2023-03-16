<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::group(['prefix' => 'quiz'], function () {
    Route::get('/', [QuizController::class, 'index']);
    Route::get('check-answer', [QuizController::class, 'checkAnswer']);
});
