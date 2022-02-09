<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTransaction extends Model
{
    protected $fillable = [
        'description',
        'is_active'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
