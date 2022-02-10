<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionExecutedSuccessfully extends Mailable
{
    use Queueable, SerializesModels;

    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }


    public function build()
    {
        return $this
        ->to($this->transaction->payer->email)
        ->subject('Pagamento Realizado')
        ->view('mail.transactionExecutedSuccessfully')
        ->with([
            'name' => $this->transaction->payer->name,
            'date' => (string)$this->transaction->created_at,
            'payee' => $this->transaction->payee->name,
            'document' => $this->transaction->payee->document,
            'value' => $this->transaction->value
        ]);
    }
}
