<?php

namespace App\Modules\Cashback\database\seeders;

use App\Modules\Cashback\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Transaction::truncate();
        $this->call([
            CustomerSeeder::class,
            PartnerSeeder::class,
            BalanceAccountSeeder::class,
            PartnerCashbackPlanSeeder::class,
            CashbackActionGroupSeeder::class,
            CashbackActionSeeder::class,
            CashbackActionAttributeSeeder::class,
        ]);
    }
}
