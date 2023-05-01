<?php

namespace Database\Seeders;

use App\Modules\Cashback\database\seeders\BalanceAccountSeeder;
use App\Modules\Cashback\database\seeders\CashbackActionAttributeSeeder;
use App\Modules\Cashback\database\seeders\CashbackActionGroupSeeder;
use App\Modules\Cashback\database\seeders\CashbackActionSeeder;
use App\Modules\Cashback\database\seeders\CustomerSeeder;
use App\Modules\Cashback\database\seeders\PartnerCashbackPlanSeeder;
use App\Modules\Cashback\database\seeders\PartnerSeeder;
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
