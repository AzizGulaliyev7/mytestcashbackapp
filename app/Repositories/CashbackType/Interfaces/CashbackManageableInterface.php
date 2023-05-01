<?php

namespace App\Modules\Repositories\CashbackType\Interfaces;

use App\Modules\Cashback\DTO\CashbackActionDTO;

interface CashbackManageableInterface
{
    public function manageCashback(CashbackActionDTO $cashbackActionDTO) : array;
}
