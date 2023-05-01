<?php

namespace App\Modules\Repositories\CashbackAble\Interfaces;

use Illuminate\Http\Request;

interface CashbackAbleRepositoryInterface
{
    public function cashback(Request $request);
}
