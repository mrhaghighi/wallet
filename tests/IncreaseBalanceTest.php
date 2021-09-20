<?php

use App\Models\Balance;
use App\Services\Balance\GetBallance;
use App\Services\Balance\IncreaseBalance;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Symfony\Component\HttpKernel\Exception\HttpException;

class IncreaseBalanceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * test for increase balance with positive amount for valid user
     *
     * @return void
     */
    public function testIncreaseBalanceWithPositiveAmountForValidUser()
    {
        // Create balance
        $balance = Balance::factory()->create();

        // Increasing balance amount
        $increasingAmount = rand(100, 999);

        // Increase value
        app()->make(IncreaseBalance::class)->increase($balance->user_id, $increasingAmount);

        // Get new value
        $newBalance = app()->make(GetBallance::class)->get($balance->user_id);

        // Assert balances
        $this->assertEquals(($balance->balance + $increasingAmount), $newBalance);
    }

    /**
     * test for increase balance with negative amount for valid user
     *
     * @return void
     */
    public function testIncreaseBalanceWithNegativeAmountForValidUser()
    {
        // Create balance
        $balance = Balance::factory()->create();

        // Increasing balance amount
        $increasingAmount = rand(-1, -999);

        // Assert increasing value
        $this->expectException(HttpException::class);
        app()->make(IncreaseBalance::class)->increase($balance->user_id, $increasingAmount);
    }

    /**
     * test for increase balance with positive amount for not valid user
     *
     * @return void
     */
    public function testIncreaseBalanceWithPositiveAmountForNotalidUser()
    {
        // Create balance
        $maxUserIdInBalances = Balance::max('user_id');
        $notValidUserId = $maxUserIdInBalances + rand(100, 1000);

        // Increasing balance amount
        $increasingAmount = rand(100, 999);

        // Assert increasing value
        $this->expectException(ModelNotFoundException::class);
        app()->make(IncreaseBalance::class)->increase($notValidUserId, $increasingAmount);
    }

    /**
     * test for increase balance with negative amount for not valid user
     *
     * @return void
     */
    public function testIncreaseBalanceWithNegativeAmountForNotalidUser()
    {
        // Create balance
        $maxUserIdInBalances = Balance::max('user_id');
        $notValidUserId = $maxUserIdInBalances + rand(100, 1000);

        // Increasing balance amount
        $increasingAmount = rand(-1, -100);

        // Assert increasing value
        $this->expectException(HttpException::class);
        app()->make(IncreaseBalance::class)->increase($notValidUserId, $increasingAmount);
    }
}
