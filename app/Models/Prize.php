<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;
    protected $table = 'prizes';
    public $timestamps = true;

    protected $fillable = [
        'sport_id', 'rank_id', 'prize', 'url'
    ];
}
