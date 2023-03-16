<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = ['num_of_users', 'num_of_finished', 'num_of_correct_answers', 'sum_of_answers'];
}
