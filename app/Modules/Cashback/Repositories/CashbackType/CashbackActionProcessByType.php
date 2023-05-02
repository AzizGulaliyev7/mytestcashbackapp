<?php

namespace App\Modules\Cashback\Repositories\CashbackType;

use App\Modules\Cashback\DTO\CashbackActionDTO;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\CashbackActionProcessInterface;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\CashbackManageableInterface;
use Illuminate\Http\Request;

class CashbackActionProcessByType implements CashbackActionProcessInterface
{
    public function processCashbackAction(Request $request)
    {
        $cashbackActionDTO = new CashbackActionDTO($request->get('user_id'), $request->get('cashback_action_id'), $request->get('attributes'));
        $cashbackImplementation = $cashbackActionDTO->getImplementationType();
        return $this->cashbackByType($cashbackImplementation, $cashbackActionDTO);
    }

    protected function cashbackByType(CashbackManageableInterface $cashbackActionRepository, $cashbackActionDTO) {
        return $cashbackActionRepository->manageCashback($cashbackActionDTO);
    }
}
