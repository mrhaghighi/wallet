<?php

namespace App\Services\Transaction;

use App\Models\Transaction;

class ReferenceNumberGenerator
{
    /**
     * Generate new reference number
     *
     * @return integer
     */
    public function generate(): int
    {
        // Generate new number
        $newReference = rand(1000000000, 9999999999);

        // Check number exists or not
        if (Transaction::where('reference', $newReference)->exists()) {
            $this->generate();
        }

        return $newReference;
    }
}
