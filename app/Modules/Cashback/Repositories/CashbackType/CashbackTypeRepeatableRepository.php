<?php

namespace App\Modules\Cashback\Repositories\CashbackType;

use App\Modules\Cashback\DTO\CashbackActionDTO;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\ActionLog;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\CashbackManageableInterface;

class CashbackTypeRepeatableRepository extends ActionLog implements CashbackManageableInterface {

    public function manageCashback(CashbackActionDTO $cashbackActionDTO) : array {
        return $this->checkIfAllAttributesArePassed($cashbackActionDTO)
            ->createCashbackLog($cashbackActionDTO)
            ->makeCashback($cashbackActionDTO);
    }
}
