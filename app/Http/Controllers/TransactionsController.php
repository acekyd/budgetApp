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
}
