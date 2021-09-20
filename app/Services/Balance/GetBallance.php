<?php

namespace App\Services\Balance;

use App\Models\Balance;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class GetBallance
{
    /**
     * Get balance
     *
     * @param integer $userId
     * @throws ModelNotFoundException
     * @return float
     */
    public function get(int $userId): float
    {
        // Get balance from database
        $balance = Balance::where('user_id', $userId)->first();

        // Check user and balance exist or not
        if (!isset($balance->balance)) {
            throw new ModelNotFoundException('Your user ID is wrong.');
        }

        // Log process
        Log::info("[Balance][Get Balance] User {$userId} got his balance. The balance is: {$balance->balance}");

        return $balance->balance;
    }
}
