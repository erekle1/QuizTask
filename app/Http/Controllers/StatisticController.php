<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatisticResource;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{

    public function index()
    {
        $stat = Statistic::first();
        return new StatisticResource($stat);
    }

    public function updateAnswers(Request $request)
    {
        $stat = Statistic::first();
        $stat->sum_of_answers++;
        if ($request->isRight) {
            $stat->num_of_correct_answers++;
        }
        return $stat->save();
    }

    public function updateFinishedStatus(Request $request)
    {
        $stat = Statistic::first();
        if ($request->isFinished) {
            $stat->num_of_finished++;
        }
        return $stat->save();
    }

    public function updateNumOfUsers()
    {
        $stat = Statistic::first();
        $stat->num_of_users++;
        return $stat->save();
    }
}
