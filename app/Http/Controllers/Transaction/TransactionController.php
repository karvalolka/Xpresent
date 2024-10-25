<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function __invoke()
    {
        $transactions = Transaction::where('user_id', auth()->id())->get();
        return Inertia::render('Transactions/Index', ['transactions' => $transactions]);
    }
}
