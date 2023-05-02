<?php

namespace App\Modules\Cashback\Repositories\CashbackType\Interfaces;

use App\Modules\Cashback\DTO\CashbackActionDTO;
use Illuminate\Http\JsonResponse;

interface CashbackManageableInterface
{
    public function manageCashback(CashbackActionDTO $cashbackActionDTO) : JsonResponse;
}
