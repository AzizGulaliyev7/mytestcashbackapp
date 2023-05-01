<?php

namespace App\Modules\Cashback\database\seeders;

use App\Modules\Cashback\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Partner::truncate();
        DB::table('partners')->insert([
            'name' => Str::random(10),
        ]);
    }
}
