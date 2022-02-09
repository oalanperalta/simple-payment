<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    protected $fillable = [
        'description',
        'is_active'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
