<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnswerResource;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return QuizResource
     */
    public function index()
    {
        $random = Quiz::inRandomOrder()->first();
        return new QuizResource($random);
    }

    public function checkAnswer(Request $request)
    {
        $quote = Quote::find($request->quote_id);
        return new AnswerResource($quote->rightAnswer());
    }

}
