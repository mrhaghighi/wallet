<?php

namespace App\Services\Balance;

use App\Models\Balance;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

        return $balance->balance;
    }
}
