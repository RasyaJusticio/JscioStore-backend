<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipAddress extends Model
{
    protected $fillable = [
        'user_id',
        'default',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
