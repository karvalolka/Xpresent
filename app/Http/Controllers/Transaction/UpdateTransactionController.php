<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class UpdateTransactionController extends Controller
{
    public function __invoke(Request $request, Transaction $transaction)
    {
        $request->validate([
            'category' => 'required|in:income,expense',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $transaction->update($request->all());
        return redirect()->route('transactions.index');
    }
}
