<?php

namespace App\Http\Controllers;

use App\Events\TransactionCreated;
use App\Http\Requests\TransactionRequest;
use App\Interfaces\TransactionRepositoryInterface;
use App\Jobs\AuthorizeTransactionProcessJob;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    protected TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Metodo para realizar transferencia
     */
    public function tranfer(TransactionRequest $request): JsonResponse
    {
        $transaction = $this->transactionRepository->createTransaction($request->all());

        /**
         * @todo Investigar o pq não está funcionando
         */
        //TransactionCreated::dispatch($transaction);

        AuthorizeTransactionProcessJob::dispatch($transaction);

        return response()->json(['data' => $transaction],Response::HTTP_CREATED);
    }

    /**
     * Metodo para buscar transações de um usuário
     */
    public function getTransactionsByUser($id, Request $request)
    {
        try {
            return response()->json(['data' => $this->transactionRepository->getAllTransactionsByUser($id, $request->perPage)],Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * Metodo para reverter a transação
     */
    public function revertTransaction($transactionId)
    {
        try {
            return response()->json(['data' => $this->transactionRepository->revertTransaction($transactionId)], Response::HTTP_ACCEPTED);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
