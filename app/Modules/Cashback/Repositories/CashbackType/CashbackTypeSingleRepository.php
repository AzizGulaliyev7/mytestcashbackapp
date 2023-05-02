<?php

namespace App\Modules\Cashback\Repositories\CashbackType;

use App\Modules\Cashback\DTO\CashbackActionDTO;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\ActionLog;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\CashbackManageableInterface;
use Illuminate\Http\JsonResponse;

class CashbackTypeSingleRepository extends ActionLog implements CashbackManageableInterface {

    public function manageCashback(CashbackActionDTO $cashbackActionDTO) : JsonResponse {
        return $this->doNotCashbackIfActionAlreadyDone($cashbackActionDTO)
            ->checkIfAllAttributesArePassed($cashbackActionDTO)
            ->createCashbackLog($cashbackActionDTO)
            ->makeCashback($cashbackActionDTO);
    }
}
