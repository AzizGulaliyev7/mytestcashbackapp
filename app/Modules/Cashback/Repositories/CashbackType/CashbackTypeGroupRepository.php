<?php

namespace App\Modules\Cashback\Repositories\CashbackType;

use App\Modules\Cashback\DTO\CashbackActionDTO;
use App\Modules\Cashback\Models\BalanceAccount;
use App\Modules\Cashback\Models\CashbackAction;
use App\Modules\Cashback\Models\CashbackActionGroup;
use App\Modules\Cashback\Models\Transaction;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\ActionLog;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\CashbackManageableInterface;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\MakeCashbackInterface;

class CashbackTypeGroupRepository extends ActionLog implements MakeCashbackInterface, CashbackManageableInterface {

    public function manageCashback(CashbackActionDTO $cashbackActionDTO) : array {
        return $this->doNotCashbackIfActionAlreadyDone($cashbackActionDTO)
            ->checkIfAllAttributesArePassed($cashbackActionDTO)
            ->createCashbackLog($cashbackActionDTO)
            ->checkIfAllActionIsDone($cashbackActionDTO)
            ->makeGroupCashback($cashbackActionDTO);
    }

    public function checkIfAllActionIsDone(CashbackActionDTO $cashbackActionDTO) {
        if ($this->isSuccess) {
            $cashbackAction = $cashbackActionDTO->getCashbackAction();
            $this->isSuccess = (CashbackActionGroup::find($cashbackAction->cashback_action_group_id))->isAllActionsDone();

            if (!$this->isSuccess) {
                $this->errorMessage = 'Not all group actions is done';
            }
        }
        return $this;
    }

    public function makeGroupCashback(CashbackActionDTO $cashbackActionDTO) : array {
        if ($this->isSuccess) {
            $cashbackAction = $cashbackActionDTO->getCashbackAction();

            $cashbackActionAmounts = CashbackAction::where('cashback_action_group_id', $cashbackAction->cashback_action_group_id)
                ->where('type', CashbackAction::CASHBACK_ACTION_TYPE_GROUP)
                ->whereNull('deleted_at')->get();

            $balanceAccount = BalanceAccount::where('customer_id', 1)->first();
            foreach ($cashbackActionAmounts as $cashbackActionAmount) {
                $transaction = Transaction::create([
                    'balance_account_id' => $balanceAccount->id,
                    'cashback_action_id' => $cashbackActionAmount->id,
                    'cashback_amount' => $cashbackActionAmount->cashback_amount,
                    'debit' => 1
                ]);

                $balanceAccount->balance += $transaction->cashback_amount;
                $balanceAccount->update();
            }

            $this->responseMessage = "Successfully created cashback";
        }

        return [
            'status_code'   =>  ($this->isSuccess ? 200 : 400),
            'json_response'   =>  [
                'result' => [
                    'success'   => $this->isSuccess,
                    'message'   => $this->responseMessage,
                    'date'      => []
                ],
                'error' => [
                    'message' => $this->errorMessage,
                    'code'    => ($this->isSuccess ? 200 : 400),
                ]
            ]
        ];
    }
}
