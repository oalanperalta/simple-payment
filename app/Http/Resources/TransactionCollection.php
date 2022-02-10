<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $collection = $this->collection;

        foreach ($collection as $key => $transaction) {
            $data[] = [
                'id' => $transaction->id,
                'payer' => $transaction->payer->name,
                'payee' => $transaction->payee->name,
                'value' => $transaction->value,
                'status' => $transaction->status->description
            ];
        }

        return [
            'data' => $data,
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage()
        ];
    }
}
