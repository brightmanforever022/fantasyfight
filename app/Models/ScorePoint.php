<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScorePoint extends Model
{
    use HasFactory;

    protected $table = 'scorepoints';
    public $timestamps = true;

    protected $fillable = [
        'question_id', 'answer_id', 'score'
    ];
}
