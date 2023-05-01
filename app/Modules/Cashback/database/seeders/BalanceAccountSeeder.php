<?php

namespace App\Modules\Cashback\database\seeders;

use App\Modules\Cashback\Models\BalanceAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BalanceAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BalanceAccount::truncate();
        DB::table('balance_accounts')->insert([
            'customer_id' => 1,
            'name' => Str::random(10)
        ]);
    }
}
