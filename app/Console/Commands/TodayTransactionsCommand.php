<?php

namespace App\Console\Commands;

use App\Services\Transaction\CalculateTotalTransactions;
use Illuminate\Console\Command;

class TodayTransactionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:today';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Print today transactions amount';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $amount = (new CalculateTotalTransactions())->getTodayAmount();
        $this->info('Today transactions amount is: ' . $amount);
    }
}