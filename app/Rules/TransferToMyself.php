<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TransferToMyself implements Rule
{
    protected int $payer;
    protected int $payee;

    public function __construct($payer, $payee)
    {
        $this->payer = $payer;
        $this->payee = $payee;
    }

    /**
     * Valida se o usuario não está fazendo a transferencia para ele mesmo
     */
    public function passes($attribute, $value)
    {
        return $this->payer !== $this->payee;
    }

    public function message()
    {
        return 'Transferring to yourself is not allowed.';
    }
}
