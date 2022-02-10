<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AllowTransfer implements Rule
{
    /**
     * @todo Ponto de melhoria: Pode buscar no banco quais os tipos de usuarios podem fazer transferencia
     */
    protected int $allowTypeUser = 1;
    protected int $typeUser;

    public function __construct($typeUser)
    {
        $this->typeUser = $typeUser;
    }

    /**
     * Verifica se o usuario e do tipo comum, caso seja lojista ele bloqueia a transferencia
     */
    public function passes($attribute, $value)
    {
        return $this->allowTypeUser === $this->typeUser;
    }

    public function message()
    {
        return 'Your profile does not allow transfer.';
    }
}
