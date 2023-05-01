<?php

namespace App\Modules\Cashback\database\seeders;

use App\Modules\Cashback\Models\PartnerCashbackPlan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PartnerCashbackPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PartnerCashbackPlan::truncate();
        DB::table('partner_cashback_plans')->insert([
            'partner_id' => 1,
            'name' => Str::random(10),
            'is_active' => true
        ]);
    }
}
