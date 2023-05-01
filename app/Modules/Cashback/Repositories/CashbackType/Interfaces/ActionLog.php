<?php

namespace App\Modules\Cashback\Repositories\CashbackType\Interfaces;

use App\Modules\Cashback\DTO\CashbackActionDTO;
use App\Modules\Cashback\Models\BalanceAccount;
use App\Modules\Cashback\Models\CashbackAction;
use App\Modules\Cashback\Models\CashbackActionLog;
use App\Modules\Cashback\Models\Transaction;

abstract class ActionLog
{
    protected bool $isSuccess;
    protected string $responseMessage;
    protected string $errorMessage;

    function __construct() {
        $this->isSuccess = true;
        $this->responseMessage = '';
        $this->errorMessage = '';
    }

    public function doNotCashbackIfActionAlreadyDone(CashbackActionDTO $cashbackActionDTO) {
        if ($cashbackActionDTO->checkIfActionIsDoneBefore()) {
            $this->isSuccess = false;
            $this->errorMessage = 'This cashback is already done';
        }
        return $this;
    }

    public function checkIfAllAttributesArePassed(CashbackActionDTO $cashbackActionDTO) {
        if ($this->isSuccess) {
            $this->isSuccess = ($cashbackActionDTO->getCashbackAction())->checkAttributes($cashbackActionDTO->attributes);
            if (!$this->isSuccess) {
                $this->errorMessage = 'Attributes are not passeded';
            }
        }
        return $this;
    }

    public function createCashbackLog(CashbackActionDTO $cashbackActionDTO) {
        if ($this->isSuccess) {
            $cashbackAction = $cashbackActionDTO->getCashbackAction();
            CashbackActionLog::create([
                'cashback_action_id'    => $cashbackAction->id,
                'user_id'               => 1,
                'status'                => 1
            ]);
        }
        return $this;
    }

    public function makeCashback($cashbackActionDTO)  : array {
        if ($this->isSuccess) {
            $cashbackAction = $cashbackActionDTO->getCashbackAction();
            $cashbackActionAmounts = CashbackAction::find($cashbackAction->id)
                ->whereNull('deleted_at')
                ->sum('cashback_amount');
            $balanceAccount = BalanceAccount::where('customer_id', 1)->first();

            $transaction = Transaction::create([
                'balance_account_id' => $balanceAccount->id,
                'cashback_action_id' => $cashbackAction->id,
                'cashback_amount' => $cashbackActionAmounts,
                'debit' => 1
            ]);

            $balanceAccount->balance += $transaction->cashback_amount;
            $balanceAccount->update();

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
