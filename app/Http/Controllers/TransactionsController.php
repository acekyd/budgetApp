<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Category;

class TransactionsController extends Controller
{
    //
    public function index(Category $category) {

        $transactions = Transaction::byCategory($category)->get();

        return view('transactions.index', compact('transactions'));
    }

    public function store()
    {
        $this->validate(request(), [
            'description' => 'required',
            'amount'    => 'required|numeric',
            'category_id' => 'required'
        ]);

        Transaction::create(request()->all());
        return redirect('/transactions');
    }
}
