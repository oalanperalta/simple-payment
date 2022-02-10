<?php

namespace App\Listeners;

use App\Events\TransactionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthorizeTransactionProcess
{

    public function handle(TransactionCreated $event)
    {
        Log::debug('AuthorizeTransactionProcess');
        $transaction = $event->transaction;

        Log::debug($transaction);

        $result = $this->checkAuthorizer();

        $this->transaction->status_id = 3;
        $this->transaction->save();


    }

    /**
     * @todo Melhoria: colocar essa URL no env, ver possibilidade de tratar o retorno
     */
    public function checkAuthorizer()
    {
        $response = Http::get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');

        Log::debug($response);

        return $response->json();
    }
}
