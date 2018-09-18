<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_can_create_transactions()
    {
        $transaction = make('App\Transaction');

        $this->post('/transactions', $transaction->toArray())
            ->assertRedirect('/transactions');

        $this->get('/transactions')
            ->assertSee($transaction->description);
    }
}