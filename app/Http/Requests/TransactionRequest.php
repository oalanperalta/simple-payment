<?php

namespace App\Http\Requests;

use App\Interfaces\StatusTransactionRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    protected StatusTransactionRepositoryInterface $statusTransactionRepository;

    public function __construct(StatusTransactionRepositoryInterface $statusTransactionRepository)
    {
        $this->statusTransactionRepository = $statusTransactionRepository;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'payer_id' => 'required',
            'payee_id' => 'required',
            'value' => 'required',
            'status_id' => 'required'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'status_id' => $this->statusTransactionRepository->getStatusTransactionByName('pendente')
        ]);
    }
}
