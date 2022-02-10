<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WalletBalance implements Rule
{
    protected float $balance;
    protected float $transferValue;
    public function __construct($balance, $transferValue)
    {
        $this->balance = $balance;
        $this->transferValue = $transferValue;
    }

    /**
     * Valida se o usuario tem saldo na carteira para fazer a transferencia
     */
    public function passes($attribute, $value)
    {
        return $this->transferValue <= $this->balance;
    }


    public function message()
    {
        return 'Balance in wallet is insufficient.';
    }
}
