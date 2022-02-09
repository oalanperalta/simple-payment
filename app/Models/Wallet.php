<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'value'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
