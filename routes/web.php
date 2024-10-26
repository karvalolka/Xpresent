<?php

use App\Http\Controllers\Transaction\{CreateTransactionController,
    DeleteTransactionController,
    EditTransactionController,
    StoreTransactionController,
    TransactionController,
    UpdateTransactionController,
};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->prefix('transaction')->group(function () {
    Route::get('/', [TransactionController::class, '__invoke'])->name('transactions.index');
    Route::get('/create', [CreateTransactionController::class, '__invoke'])->name('transactions.create');
    Route::post('/', [StoreTransactionController::class, '__invoke'])->name('transactions.store');
    Route::get('/{transaction}/edit', [EditTransactionController::class, '__invoke'])->name('transactions.edit');
    Route::put('/{transaction}', [UpdateTransactionController::class, '__invoke'])->name('transactions.update');
    Route::delete('/{transaction}', [DeleteTransactionController::class, '__invoke'])->name('transactions.destroy');

});

require __DIR__ . '/auth.php';
