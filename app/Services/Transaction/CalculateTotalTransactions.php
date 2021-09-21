<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use Carbon\Carbon;

class CalculateTotalTransactions
{
    /**
     * Get today transactions amount
     *
     * @return float
     */
    public function getTodayAmount(): float
    {
        $today = Carbon::today();
        $amount = Transaction::whereDate('created_at', $today)
            ->sum('amount');

        return $amount;
    }

    /**
     * Get total transactions amount
     *
     * @return float
     */
    public function getTotalAmount(): float
    {
        return Transaction::sum('amount');
    }
}
