<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    public $timestamps = true;

    protected $fillable = [
        'status', 'reference', 'gameuser_id', 'credit', 'amount'
    ];


    public function user() {
        return $this->belongsTo(GameUser::class, 'gameuser_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
