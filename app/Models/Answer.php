<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Question;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';
    public $timestamps = true;

    protected $fillable = [
        'question_id', 'name', 'answer_id', 'projected_points', 'actual_points'
    ];

    // public function question(){
    //     $this->belongsTo(Question::class, 'question_id');
    // }
}
