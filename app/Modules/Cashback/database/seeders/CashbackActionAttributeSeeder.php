<?php

namespace App\Modules\Cashback\database\seeders;

use App\Modules\Cashback\Models\CashbackActionAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashbackActionAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CashbackActionAttribute::truncate();
        DB::table('cashback_action_attributes')->insert([
            'cashback_action_id' => '1',
            'name' => 'total_price',
            'condition' => '>',
            'value' => 200000
        ]);

        DB::table('cashback_action_attributes')->insert([
            'cashback_action_id' => '1',
            'name' => 'total_price2',
            'condition' => '>',
            'value' => 300000
        ]);

//      ------------------------------------------------------
        DB::table('cashback_action_attributes')->insert([
            'cashback_action_id' => 2,
            'name' => 'total_price',
            'condition' => '>',
            'value' => 200000
        ]);

        DB::table('cashback_action_attributes')->insert([
            'cashback_action_id' => 2,
            'name' => 'total_price2',
            'condition' => '>',
            'value' => 300000
        ]);

//        -----------------------------------------------------
        DB::table('cashback_action_attributes')->insert([
            'cashback_action_id' => 3,
            'name' => 'total_price',
            'condition' => '>',
            'value' => 200000
        ]);

        DB::table('cashback_action_attributes')->insert([
            'cashback_action_id' => 3,
            'name' => 'total_price2',
            'condition' => '>',
            'value' => 300000
        ]);
    }
}
