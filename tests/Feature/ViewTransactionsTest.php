<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_can_display_all_transactions()
    {
        $transaction = create('App\Transaction');

        $this->get('/transactions')
            ->assertSee($transaction->description)
            ->assertSee($transaction->category->name);
    }

    /**
     * @test
     */
    public function it_can_filter_transactions_by_category()
    {
        $category = create('App\Category');
        $transaction = create('App\Transaction', ['category_id' => $category->id]);
        $otherTransaction = create('App\Transaction');

        $this->get('/transactions/' . $category->slug)
            ->assertSee($transaction->description)
            ->assertDontSee($otherTransaction->description);
    }
}
