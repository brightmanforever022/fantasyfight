<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $table = 'sports';
    public $timestamps = true;

    protected $fillable = [
        'name', 'sport_id', 'emails_group', 'image', 'description', 'redirect_title', 'redirect_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
