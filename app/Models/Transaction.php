<?php

namespace App\Models;

use App\Events\TransactionCreated;
use App\Jobs\AuthorizeTransactionProcessJob;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'payer_id',
        'payee_id',
        'value',
        'status_id',
    ];

    /* protected $dispatchesEvents = [
        'created' => AuthorizeTransactionProcessJob::class
    ]; */

    /**
     * Relacionamento com a table Users - Pagante
     */
    public function payer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com a table Users - Recebedor
     */
    public function payee()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com a tabela Statuses
     */
    public function status()
    {
        return $this->belongsTo(StatusTransaction::class);
    }
}
