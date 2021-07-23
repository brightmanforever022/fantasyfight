<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Answer;

class UserPoint extends Model
{
    use HasFactory;

    protected $table = 'userpoints';
    public $timestamps = false;

    protected $fillable = [
        'username', 'question_id', 'answer_id', 'created_at'
    ];

    // public function debts(){
    //     return $this->hasMany(Answer::class)->selectRaw('answers.*,sum(actual_points) as sum');
    // }
}
