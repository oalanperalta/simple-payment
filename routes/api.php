<?php

use App\Http\Controllers\TransactionController;
use App\Mail\ReceivedTransaction;
use App\Mail\ReversedTransaction;
use App\Mail\TransactionExecutedSuccessfully;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('transaction', [TransactionController::class, 'tranfer']);
Route::put('transaction/{id}/revert', [TransactionController::class, 'revertTransaction']);
Route::get('user/{id}/transaction', [TransactionController::class, 'getTransactionsByUser']);

Route::get('testMail', function () {
    $transaction = Transaction::find(91);
    Mail::send(new ReversedTransaction($transaction));
});
