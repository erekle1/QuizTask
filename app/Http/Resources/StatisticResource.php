<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $correctAnswersPercentage = round(($this->num_of_correct_answers / $this->sum_of_answers) * 100, 2);
        $finishedPercentage = round(($this->num_of_finished / $this->num_of_users) * 100, 2);
        return [
            'num_of_users'        => $this->num_of_users,
            'finished_percentage' => $finishedPercentage,
            'incorrect_answers'   => 100 - $correctAnswersPercentage,
            'correct_answers'     => $correctAnswersPercentage
        ];
    }
}
