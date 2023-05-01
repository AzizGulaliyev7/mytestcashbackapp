<?php

namespace App\Modules\Repositories\CashbackType\Interfaces;

use App\Modules\Cashback\DTO\CashbackActionDTO;

interface MakeCashbackInterface
{
    public function makeGroupCashback(CashbackActionDTO $cashbackActionDTO);
}
