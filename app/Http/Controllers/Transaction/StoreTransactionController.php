<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StoreTransactionController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'category' => 'required|in:income,expense',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Transaction::create(array_merge($request->all(), ['user_id' => auth()->id()]));
        return redirect()->route('transactions.index');
    }
}
