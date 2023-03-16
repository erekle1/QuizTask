<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Quote;
use App\Models\Statistic;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Quiz::factory()->count(25)
            ->has(Quote::factory()->count(10)
                ->hasAttached(Answer::factory()->count(4), new Sequence(function ($sequence) {
                    if ($sequence->index % 4 == 0) {
                        return ['is_correct' => 1];
                    }
                    return ['is_correct' => 0];
                })))->create();

        Statistic::create([
            'num_of_users' => 0, 'num_of_finished' => 0, 'num_of_correct_answers' => 0, 'sum_of_answers' => 0
        ]);
    }


}

