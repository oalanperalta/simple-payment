<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReverseTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Transaction $transaction;
    public WalletRepository $walletRepositoryInterface;
    public StatusTransactionRepository $statusTransactionRepository;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->walletRepositoryInterface = new WalletRepository();
        $this->statusTransactionRepository = new StatusTransactionRepository();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
