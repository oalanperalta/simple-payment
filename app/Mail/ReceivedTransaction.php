<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReceivedTransaction extends Mailable
{
    use Queueable, SerializesModels;

    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->to($this->transaction->payee->email)
        ->view('mail.receivedTransaction')
        ->subject('Você recebeu uma transferência')
        ->with([
            'name' => $this->transaction->payee->name,
            'date' => (string)$this->transaction->created_at,
            'payer' => $this->transaction->payer->name,
            'document' => $this->transaction->payer->document,
            'value' => $this->transaction->value
        ]);
    }
}
