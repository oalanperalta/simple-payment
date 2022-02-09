<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'payer_id',
        'payee_id',
        'value',
        'status_id',
    ];

    /**
     * Relacionamento com a table Users - Pagante
     */
    public function payer()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Relacionamento com a table Users - Recebedor
     */
    public function payee()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Relacionamento com a tabela Statuses
     */
    public function status()
    {
        return $this->hasOne(Status::class);
    }
}
