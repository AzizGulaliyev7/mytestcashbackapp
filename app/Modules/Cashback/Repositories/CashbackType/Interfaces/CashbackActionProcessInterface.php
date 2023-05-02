<?php

namespace App\Modules\Cashback\Repositories\CashbackType\Interfaces;

use Illuminate\Http\Request;

interface CashbackActionProcessInterface
{
    public function processCashbackAction(Request $request);
}
