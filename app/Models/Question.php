<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Answer;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    public $timestamps = true;

    protected $fillable = [
        'game_id', 'name'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}
