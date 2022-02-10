<?php

namespace App\Http\Requests;

use App\Interfaces\StatusTransactionRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\WalletRepositoryInterface;
use App\Rules\AllowTransfer;
use App\Rules\TransferToMyself;
use App\Rules\WalletBalance;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    protected StatusTransactionRepositoryInterface $statusTransactionRepository;
    protected UserRepositoryInterface $userRepository;
    protected WalletRepositoryInterface $walletRepository;

    public function __construct(
        StatusTransactionRepositoryInterface $statusTransactionRepository,
        UserRepositoryInterface $userRepository,
        WalletRepositoryInterface $walletRepository
    ) {
        $this->statusTransactionRepository = $statusTransactionRepository;
        $this->userRepository = $userRepository;
        $this->walletRepository = $walletRepository;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $typeId = $this->userRepository->getTypeById($this->payer_id);
        $walletBalance = $this->walletRepository->getBalanceByUserId($this->payer_id);

        return [
            'payer_id' => [
                'required',
                 new AllowTransfer($typeId),
                 new WalletBalance($walletBalance, floatval($this->value)),
                 new TransferToMyself($this->payer_id, $this->payee_id)
                ],
            'payee_id' => 'required',
            'value' => 'required',
            'status_id' => 'required'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'status_id' => $this->statusTransactionRepository->getStatusTransactionByName('Processando')
        ]);
    }
}
