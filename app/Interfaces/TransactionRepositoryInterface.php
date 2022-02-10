<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface
{
    public function getAllTransactionsByUser(int $payer_id, int $perPage = 15);
    public function getTransactionById(int $transactionId);
    public function deleteTransaction(int $transactionId);
    public function createTransaction(array $transactionDetails);
    public function revertTransaction(int $transactionId);
    public function changeToInDispute(int $transactionId);
}
