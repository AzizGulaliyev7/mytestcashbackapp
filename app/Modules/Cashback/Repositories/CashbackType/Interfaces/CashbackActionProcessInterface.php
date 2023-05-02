<?php

namespace App\Modules\Cashback\Repositories\CashbackType\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface CashbackActionProcessInterface
{
    public function processCashbackAction(Request $request) : JsonResponse;
}
