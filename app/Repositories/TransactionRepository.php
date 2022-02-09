<?php
namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAllTransactions()
    {
        return Transaction::all();
    }

    public function getTransactionById($transactionId)
    {
        return Transaction::findOrFail($transactionId);
    }

    public function deleteTransaction($transactionId)
    {
        Transaction::destroy($transactionId);
    }

    public function createTransaction(array $transactionDetails)
    {
        return Transaction::create($transactionDetails);
    }

    public function updateTransaction($transactionId, array $transactionDetails)
    {
        return Transaction::whereId($transactionId)->update($transactionDetails);
    }
}
