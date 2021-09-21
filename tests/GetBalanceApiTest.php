<?php

use App\Models\Balance;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GetBalanceApiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * test getting balance for a valid user
     *
     * @return void
     */
    public function testGettingBalanceForValidUserViaApi()
    {
        // Create a balance
        $balance = Balance::factory()->create();

        $this->json('GET', "/balances/{$balance->user_id}")
            ->seeJson([
                'status' => 'success'
            ])
            ->assertResponseOk();
    }

    /**
     * test getting balance for a not valid user
     *
     * @return void
     */
    public function testGettingBalanceForNotValidUserViaApi()
    {
        // Create a balance
        $maxUserId = Balance::max('user_id');
        $notValidUserId = $maxUserId + rand(100, 1000);

        $this->json('GET', "/balance/{$notValidUserId}")
            ->assertResponseStatus(404);
    }
}
