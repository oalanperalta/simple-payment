<?php

namespace App\Repositories;

use App\Interfaces\WalletRepositoryInterface;
use App\Models\User;
use App\Models\Wallet;

class WalletRepository implements WalletRepositoryInterface
{
    /**
     * Busca o saldo da carteira
     */
    public function getBalanceByUserId($userId)
    {
        return Wallet::whereHas('user', function ($query) use ($userId) {
            return $query->where('id', $userId);
        })->pluck('value')->first();
    }

    /**
     * Busca a carteira do usuario
     */
    public function getWalletByUserId($userId)
    {
        return Wallet::where('user_id', $userId)->first();
    }

    /**
     * Faz a subtração do valor da transferência na carteira do usuário
     */
    public function subtractBalance($wallet, $value)
    {
        $wallet->value -= $value;
        return $wallet->save();
    }

    /**
     * Faz a adição do valor da transferência na carteira do usuário
     */
    public function addBalance($wallet, $value)
    {
        $wallet->value += $value;
        return $wallet->save();
    }

}
