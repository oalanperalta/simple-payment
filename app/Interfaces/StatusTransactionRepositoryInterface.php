<?php

namespace App\Interfaces;

interface StatusTransactionRepositoryInterface
{
    public function getStatusTransactionByName(string $statusDescription);

    public function authorized(int $statusId);
    public function inDispute(int $statusId);
    public function returned(int $statusId);

    public function getInDispute();
    public function getReturned();
    public function getAuthorized();
    public function getRefused();
}
