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
     * Testa um usuario lojista, o mesmo não pode fazer transferencia
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
            ->assertStatus(422)
            ->assertJsonFragment([
                'errors' => [
                    'payer_id' => ['Your profile does not allow transfer.'],
                ],
            ]);
    }

    /**
     * Teste usuario com saldo em carteira
     * @test
     */
    public function check_user_with_wallet_balance()
    {
        $payload = [
            'payer_id' => 1,
            'payee_id' => 2,
            'value' => 100
        ];

        $response = $this->postJson('api/transaction', $payload);
        $response->assertStatus(201);
    }

    /**
     * Teste usuario sem saldo em carteira
     * @test
     */
    public function check_user_with_no_balance_in_the_wallet()
    {
        $payload = [
            'payer_id' => 1,
            'payee_id' => 2,
            'value' => 123.51
        ];

        $response = $this->postJson('api/transaction', $payload);
        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                'errors' => [
                    'payer_id' => ['Balance in wallet is insufficient.'],
                ],
            ]);;
    }

    /**
     * Checa se não é permitido enviar transferencia para si mesmo
     * @test
     */
    public function check_transfer_for_yourself_is_not_allowed()
    {
        $payload = [
            'payer_id' => 2,
            'payee_id' => 2,
            'value' => 123.51
        ];

        $response = $this->postJson('api/transaction', $payload);
        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                'errors' => [
                    'payer_id' => ['Transferring to yourself is not allowed.'],
                ],
            ]);;
    }
}
