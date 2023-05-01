<?php

namespace App\Modules\Cashback\Repositories\CashbackType\Interfaces;

use App\Modules\Cashback\DTO\CashbackActionDTO;

interface MakeCashbackInterface
{
    public function makeGroupCashback(CashbackActionDTO $cashbackActionDTO);
}
