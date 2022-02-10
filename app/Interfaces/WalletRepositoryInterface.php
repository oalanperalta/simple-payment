<?php

namespace App\Interfaces;

use App\Models\Wallet;

interface WalletRepositoryInterface
{
    public function getBalanceByUserId(int $userId);
    public function getWalletByUserId(int $userId);
    public function subtractBalance(Wallet $wallet, float $value);
    public function addBalance(Wallet $wallet, float $value);
}
