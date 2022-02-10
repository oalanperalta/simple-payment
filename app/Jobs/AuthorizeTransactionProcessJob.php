<?php

namespace App\Jobs;

use App\Mail\TransactionExecutedSuccessfully;
use App\Models\Transaction;
use App\Repositories\StatusTransactionRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class AuthorizeTransactionProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Transaction $transaction;
    protected StatusTransactionRepository $statusTransactionRepository;
    protected TransactionRepository $transactionRepository;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->statusTransactionRepository = new StatusTransactionRepository();
        $this->transactionRepository = new TransactionRepository($this->statusTransactionRepository);
    }

    public function handle()
    {
        $return = $this->checkAuthorizer();

        if ($return === 'Autorizado') {
            if ($this->transactionRepository->changeStatusId($this->transaction->id, $this->statusTransactionRepository->getAuthorized())) {
                ChangeWalletBalanceJob::dispatch($this->transaction, $this->statusTransactionRepository);
                Mail::send(new TransactionExecutedSuccessfully($this->transaction));
            }
        } else {
            $this->transactionRepository->changeStatusId($this->transaction->id, $this->statusTransactionRepository->getAuthorized());
        }
    }

    public function checkAuthorizer()
    {
        $response = Http::get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
        return $response->json('message');
    }
}
