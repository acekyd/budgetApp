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

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_a_description()
    {
        $this->postTransaction(['description' => null])
            ->assertSessionHasErrors('description');
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_a_category()
    {
        $this->postTransaction(['category_id' => null])
            ->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_an_amount()
    {
        $this->postTransaction(['amount' => null])
            ->assertSessionHasErrors('amount');
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_a_valid_amount()
    {
        $this->postTransaction(['amount' => 'abc'])
            ->assertSessionHasErrors('amount');
    }

    public function postTransaction($overrides = [])
    {
        $transaction = make('App\Transaction', $overrides);

        return $this->withExceptionHandling()->post('/transactions', $transaction->toArray());
    }
}