<?php

namespace App\Modules\Cashback\database\seeders;

use App\Modules\Cashback\Models\CashbackActionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CashbackActionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CashbackActionGroup::truncate();
        DB::table('cashback_action_groups')->insert([
            'name' => Str::random(10),
            'partner_cashback_plan_id' => 1
        ]);
    }
}
