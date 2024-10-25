<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CreateTransactionController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Transactions/Create');
    }
}
