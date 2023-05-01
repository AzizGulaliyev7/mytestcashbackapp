<?php

namespace App\Modules\Cashback\database\seeders;

use App\Modules\Cashback\Models\CashbackActionLog;
use App\Modules\Cashback\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::truncate();
        CashbackActionLog::truncate();
        DB::table('customers')->insert([
            'name' => Str::random(10),
            'phone_number' => '998904635544',
        ]);
    }
}
