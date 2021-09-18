<?php

namespace App\Http\Controllers;

use App\Services\Balance\GetBallance;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class WalletController extends Controller
{
    /**
     * Show user balance
     *
     * @param integer $userId
     * @throws NotAcceptableHttpException
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $userId)
    {
        // Fetch balance
        $balance = app()->make(GetBallance::class)->get($userId);

        return response()->json([
            'status'  => 'success',
            'data'    => [
                'balance' => $balance
            ],
            'message' => null
        ]);
    }
}
