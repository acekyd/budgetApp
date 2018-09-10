<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionsController extends Controller
{
    //
    public function index() {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }
}
