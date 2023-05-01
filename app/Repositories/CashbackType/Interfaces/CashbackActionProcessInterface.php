<?php

namespace App\Modules\Repositories\CashbackType\Interfaces;

use Illuminate\Http\Request;

interface CashbackActionProcessInterface
{
    public function processCashbackAction(Request $request) : array;
}
