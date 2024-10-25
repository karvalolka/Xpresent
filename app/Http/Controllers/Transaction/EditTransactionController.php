<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Inertia\Inertia;

class EditTransactionController extends Controller
{
    public function __invoke(Transaction $transaction)
    {
        return Inertia::render('Transactions/Edit', ['transaction' => $transaction]);
    }
}
