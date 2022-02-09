<?php

namespace App\Providers;

use App\Interfaces\StatusTransactionRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Repositories\StatusTransactionRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(StatusTransactionRepositoryInterface::class, StatusTransactionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
