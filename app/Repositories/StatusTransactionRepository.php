<?php

namespace App\Repositories;

use App\Interfaces\StatusTransactionRepositoryInterface;
use App\Models\StatusTransaction;
use Illuminate\Support\Facades\Log;

class StatusTransactionRepository implements StatusTransactionRepositoryInterface
{
    /**
     * Busca o status pelo nome
     */
    public function getStatusTransactionByName($statusDescription)
    {
        return StatusTransaction::where('description', $statusDescription)->pluck('id')->first();
    }

    /**
     * Verifica se a transação esta "autorizada"
     */
    public function authorized($statusId)
    {
        return $statusId === $this->getStatusTransactionByName('Autorizado');
    }

    /**
     * Verifica se a transação esta "em disputa"
     */
    public function inDispute($statusId)
    {
        return $statusId === $this->getStatusTransactionByName('Em disputa');
    }

    /**
     * Verifica se a transação esta "Devolvido"
     */
    public function returned($statusId)
    {
        return $statusId === $this->getStatusTransactionByName('Devolvido');
    }

    /**
     * Informa o ID do status "em disputa"
     */
    public function getInDispute()
    {
        return $this->getStatusTransactionByName('Em disputa');
    }

    /**
     * Informa o ID do status "Devolvido"
     */
    public function getReturned()
    {
        return $this->getStatusTransactionByName('Devolvido');
    }

    /**
     * Informa o ID do status "Autorizado"
     */
    public function getAuthorized()
    {
        return $this->getStatusTransactionByName('Autorizado');
    }

    /**
     * Informa o ID do status "Recusado"
     */
    public function getRefused()
    {
        return $this->getStatusTransactionByName('Recusado');
    }
}
