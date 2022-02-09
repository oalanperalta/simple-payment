<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * Usuario relazinado um transferência entre usuarios comuns
     *
     * @test
     */
    public function performing_a_transfer_between_common_users()
    {
        $payload = [
            'payer_id' => 1,
            'payee_id' => 2,
            'value' => 10
        ];

        $response = $this->postJson('api/transaction', $payload);
        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'payer_id',
                    'payee_id',
                    'value',
                    'status_id',
                    'updated_at',
                    'created_at'
                ],
            ]);
    }

    /**
     * @test
     */
    public function performing_a_transfer_between_shopkeeper_and_common_user()
    {
        $payload = [
            'payer_id' => 3,
            'payee_id' => 1,
            'value' => 1000
        ];

        $response = $this->postJson('api/transaction', $payload);
        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'payer_id',
                    'payee_id',
                    'value',
                    'status_id',
                    'updated_at',
                    'created_at'
                ],
            ]);
    }
}
