<?php

namespace App\Modules\Cashback\Repositories\CashbackType\Interfaces;

use App\Modules\Cashback\DTO\CashbackActionDTO;

interface CashbackManageableInterface
{
    public function manageCashback(CashbackActionDTO $cashbackActionDTO);
}
