<?php

namespace App\Services\Balance;

use App\Models\Balance;
use App\Models\Transaction;
use App\Services\Transaction\ReferenceNumberGenerator;
use App\Services\Validate\ValidateUser;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class IncreaseBalance
{
    /**
     * Transaction init status
     */
    const TRANSACTION_INIT_STATUS = 'INIT';

    /**
     * Transaction successful status
     */
    const TRANSACTION_SUCCESSFUL_STATUS = 'SUCCESSFUL';

    /**
     * Transaction failed status
     */
    const TRANSACTION_FAILED_STATUS = 'FAILED';

    /**
     * Increase user balance
     *
     * @param integer $userId
     * @param float $amount
     * @return array
     */
    public function increase(int $userId, float $amount): array
    {
        // Validate amount & user ID
        $this->validate($userId, $amount);

        // Create transaction
        $referenceNumber = app()->make(ReferenceNumberGenerator::class)->generate();
        $transaction = Transaction::create([
            'reference' => $referenceNumber,
            'user_id'   => $userId,
            'amount'    => $amount,
            'status'    => self::TRANSACTION_INIT_STATUS
        ]);

        // Add balance & update transaction status
        try {
            Balance::where('user_id', $userId)
                ->first()
                ->increment('balance', $amount);

            // Update transaction status
            $transaction->update([
                'status' => self::TRANSACTION_SUCCESSFUL_STATUS
            ]);

            $status = true;
        } catch (Exception $exception) {
            Log::error('[Transaction][Add Balance] An error occurred when incrementing user balance. Exception: ' . $exception->getMessage());

            // Update transaction status
            $transaction->update([
                'status' => self::TRANSACTION_FAILED_STATUS
            ]);

            $status = false;
        }

        return [
            'status'    => $status,
            'reference' => $referenceNumber
        ];
    }

    /**
     * Validate request
     *
     * @param integer $userId
     * @param float $amount
     * @throws ModelNotFoundException
     * @throws HttpException
     * @return void
     */
    protected function validate(int $userId, float $amount): void
    {
        // Check user wallet exists or not
        if (!app()->make(ValidateUser::class)->checkWalletExistence($userId)) {
            throw new ModelNotFoundException("There isn't any wallet for this user.");
        }

        // Check amount is positive or not
        if ($amount < 0) {
            throw new HttpException(500, 'The amount should be positive.');
        }
    }
}
