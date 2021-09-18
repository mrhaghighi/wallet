<?php

namespace App\Services\Validate;

use App\Models\Balance;

class ValidateUser
{
    /**
     * Check wallet existence
     *
     * @param integer $userId
     * @return boolean
     */
    public function checkWalletExistence(int $userId): bool
    {
        return Balance::where('user_id', $userId)->exists();
    }
}
