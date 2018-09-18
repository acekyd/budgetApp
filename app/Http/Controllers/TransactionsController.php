<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Category;

class TransactionsController extends Controller
{
    //
    public function index(Category $category = null) {
        if($category->exists)
        {
            $transactions = Transaction::where('category_id', $category->id)->get();
        }
        else {
            $transactions = Transaction::all();
        }
        return view('transactions.index', compact('transactions'));
    }
}
