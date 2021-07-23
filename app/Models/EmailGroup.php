<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailGroup extends Model
{
    use HasFactory;

    protected $table = 'emailsgroup';
    public $timestamps = true;

    protected $fillable = [
        'sport_id', 'email'
    ];

}
