<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';
    public $timestamps = true;

    protected $fillable = [
        'sport_id', 'name', 'game_id', 'game_start_day', 'game_start_time', 'game_end_day', 'game_end_time', 'game_url', 'game_fired'
    ];
}
