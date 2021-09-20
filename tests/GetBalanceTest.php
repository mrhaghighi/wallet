<?php

use App\Models\Balance;
use App\Services\Balance\GetBallance;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GetBalanceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * test getting balance for a valid user
     *
     * @return void
     */
    public function testGettingBalanceForValidUser()
    {
        // Create a balance
        $balance = Balance::factory()->create();

        // Get balance
        $fetchedBalance = app()->make(GetBallance::class)->get($balance->user_id);

        // Assert balance
        $this->assertIsFloat($fetchedBalance);
    }

    /**
     * test getting balance for a not valid user
     *
     * @return void
     */
    public function testGettingBalanceForNotValidUser()
    {
        // Create a balance
        $maxUserIdInBalances = Balance::max('user_id');
        $notValidUserId = $maxUserIdInBalances + rand(100, 1000);

        // Assert getting balance
        $this->expectException(ModelNotFoundException::class);
        app()->make(GetBallance::class)->get($notValidUserId);
    }
}
