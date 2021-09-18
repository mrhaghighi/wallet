<?php

namespace App\Http\Controllers;

use App\Services\Balance\GetBallance;
use App\Services\Balance\IncreaseBalance;
use Illuminate\Http\Request;
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

    /**
     * Show user balance
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate request
        $this->validate($request, [
            'user'   => 'required|integer',
            'amount' => 'required|numeric|min:0'
        ]);

        // Add balance
        $addBalance = app()->make(IncreaseBalance::class)->increase(
            $request->input('user'),
            $request->input('amount')
        );

        return response()->json([
            'status'  => $addBalance['status'] ? 'success' : 'failed',
            'data'    => [
                'reference_number' => $addBalance['reference']
            ],
            'message' => null
        ]);
    }
}
