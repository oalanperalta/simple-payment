<?php
namespace App\Repositories;

use App\Interfaces\StatusTransactionRepositoryInterface;
use App\Models\StatusTransaction;

class StatusTransactionRepository implements StatusTransactionRepositoryInterface
{
    public function getStatusTransactionByName($statusDescription)
    {
        return StatusTransaction::where('description', $statusDescription)->pluck('id')->first();
    }
}
