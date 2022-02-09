<?php

namespace App\Interfaces;

interface StatusTransactionRepositoryInterface
{
    public function getStatusTransactionByName($statusDescription);
}
