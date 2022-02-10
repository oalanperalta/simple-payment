<?php

namespace App\Repositories;

use App\Http\Resources\TransactionCollection;
use App\Interfaces\StatusTransactionRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Jobs\ChangeWalletBalanceJob;
use App\Jobs\ReverseTransactionJob;
use App\Models\StatusTransaction;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Log;

class TransactionRepository implements TransactionRepositoryInterface
{
    protected StatusTransactionRepositoryInterface $statusTransactionRepository;

    public function __construct(StatusTransactionRepositoryInterface $statusTransactionRepository)
    {
        $this->statusTransactionRepository = $statusTransactionRepository;
    }

    /**
     * Busca as transações dos usuários comuns
     */
    public function getAllTransactionsByUser($payer_id, $perPage = 15)
    {
        $transactions = Transaction::where('payer_id', $payer_id)->orderBy('id', 'DESC')->paginate($perPage);
        if (!$transactions->isEmpty()) {
            return new TransactionCollection($transactions);
        } else {
            throw new Exception("Não foi possível listar transações do usuário.");
        }
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

    /**
     * @todo Melhorar código
     */
    public function revertTransaction($transactionId)
    {
        if ($this->allowRevertTransfer($transactionId)) {
            if ($this->changeToInDispute($transactionId)) {
                ChangeWalletBalanceJob::dispatch($this->getTransactionById($transactionId));
            }
        } else {
            throw new Exception('Não é possível reverter transação.');
        }
    }

    /**
     * Muda o status da transação
     */
    public function changeStatusId($transactionId, $statusId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        if ($transaction) {
            $transaction->status_id = $statusId;
            return $transaction->save();
        }
    }

    /**
     * Muda o status da transação para Em disputa
     */
    public function changeToInDispute($transactionId)
    {
        return $this->changeStatusId($transactionId, $this->statusTransactionRepository->getInDispute());
    }

    /**
     * Muda o status da transação para "Devolvido"
     */
    public function changeToReturned($transactionId)
    {
        return $this->changeStatusId($transactionId, $this->statusTransactionRepository->getReturned());
    }

    /**
     * Verifica se pode reverter a transação
     */
    public function allowRevertTransfer($transactionId)
    {
        $transaction = $this->getTransactionById($transactionId);
        return !$this->statusTransactionRepository->inDispute($transaction->status_id) && !$this->statusTransactionRepository->returned($transaction->status_id);
    }
}
