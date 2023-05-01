<?php

namespace App\Modules\Cashback\database\seeders;

use App\Modules\Cashback\Models\CashbackAction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CashbackActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CashbackAction::truncate();
        DB::table('cashback_actions')->insert([
            'cashback_action_group_id' => 1,
            'name' => Str::random(10),
            'cashback_amount' => 50000,
            'type' => 'group_acton'
        ]);

        DB::table('cashback_actions')->insert([
            'cashback_action_group_id' => 1,
            'name' => Str::random(10),
            'cashback_amount' => 5000,
            'type' => 'repeatable_acton'
        ]);

        DB::table('cashback_actions')->insert([
            'cashback_action_group_id' => 1,
            'name' => Str::random(10),
            'cashback_amount' => 20000,
            'type' => 'single_acton'
        ]);
    }
}
