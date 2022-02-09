<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Interfaces\TransactionRepositoryInterface;
use App\Repositories\TransactionRepository;
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
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }

    public function store(TransactionRequest $request): JsonResponse
    {
        return response()->json(
            [
                'data' => $this->transactionRepository->createTransaction($request->all())
            ],
            Response::HTTP_CREATED
        );
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
