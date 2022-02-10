<?php

namespace App\Jobs;

use App\Mail\ReversedTransaction;
use App\Models\Transaction;
use App\Repositories\StatusTransactionRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\WalletRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ChangeWalletBalanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Transaction $transaction;
    public WalletRepository $walletRepositoryInterface;
    public StatusTransactionRepository $statusTransactionRepository;
    public TransactionRepository $transactionRepository;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->walletRepositoryInterface = new WalletRepository();
        $this->statusTransactionRepository = new StatusTransactionRepository();
        $this->transactionRepository = new TransactionRepository($this->statusTransactionRepository);
    }


    public function handle()
    {
        /**
         * Se a transação tiver status "autorizada"
         */
        if ($this->statusTransactionRepository->authorized($this->transaction->status_id)) {
            if ($this->subtractBalance($this->transaction->payer_id)) {
                $this->addBalance($this->transaction->payee_id);
            }
        }

        /**
         * Se a transação tiver status "Em disputa"
         */
        if ($this->statusTransactionRepository->inDispute($this->transaction->status_id)) {
            if ($this->subtractBalance($this->transaction->payee_id)) {
                if ($this->addBalance($this->transaction->payer_id)) {
                    Mail::send(new ReversedTransaction($this->transaction));
                    return $this->transactionRepository->changeStatusId($this->transaction->id, $this->statusTransactionRepository->getReturned());
                }
            }
        }
    }

    /**
     * Busca a carteira para subtrai o valor da transferência
     */
    public function subtractBalance($user_id)
    {
        $wallet = $this->walletRepositoryInterface->getWalletByUserId($user_id);
        return $this->walletRepositoryInterface->subtractBalance($wallet, $this->transaction->value);
    }

    /**
     * Busca a carteira para somar o valor da transferência
     */
    public function addBalance($user_id)
    {
        $wallet = $this->walletRepositoryInterface->getWalletByUserId($user_id);
        return $this->walletRepositoryInterface->addBalance($wallet, $this->transaction->value);
    }
}
