<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReversedTransaction extends Mailable
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
        ->subject('Pagamento estornado')
        ->view('mail.reversedTransaction')
        ->with([
            'name' => $this->transaction->payer->name,
            'date' => (string)$this->transaction->updated_at,
            'value' => $this->transaction->value
        ]);
    }
}
