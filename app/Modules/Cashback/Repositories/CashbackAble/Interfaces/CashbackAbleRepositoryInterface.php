<?php

namespace App\Modules\Cashback\Repositories\CashbackAble\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface CashbackAbleRepositoryInterface
{
    public function cashback(Request $request) : JsonResponse;
}
