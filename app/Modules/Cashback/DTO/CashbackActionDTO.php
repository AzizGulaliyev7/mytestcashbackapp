<?php

namespace App\Modules\Cashback\DTO;

use App\Modules\Cashback\Models\CashbackAction;
use App\Modules\Cashback\Repositories\CashbackType\CashbackTypeGroupRepository;
use App\Modules\Cashback\Repositories\CashbackType\CashbackTypeRepeatableRepository;
use App\Modules\Cashback\Repositories\CashbackType\CashbackTypeSingleRepository;
use Illuminate\Support\Facades\DB;

class CashbackActionDTO
{
    public int $user_id;
    public int $cashback_action_id;
    public array $attributes;

    public function __construct($user_id, $cashback_action_id, $attributes)
    {
        $this->user_id = $user_id;
        $this->cashback_action_id = $cashback_action_id;
        $this->attributes = $attributes;
    }

    public function getCashbackAction() {
        $cashbackAction = CashbackAction::find($this->cashback_action_id);
        return $cashbackAction;
    }

    public function getImplementationType() {
        $actionTypes = array(
            'group_acton' => CashbackTypeGroupRepository::class,
            'single_acton' => CashbackTypeSingleRepository::class,
            'repeatable_acton' => CashbackTypeRepeatableRepository::class
        );

        return app()->make($actionTypes[(($this->getCashbackAction())->type)]);
    }

    public function checkIfActionIsDoneBefore() {
        $isactionLogExists = DB::table('cashback_action_logs')
            ->whereNull('deleted_at')
            ->where('cashback_action_id', $this->cashback_action_id)
            ->where('user_id', $this->user_id)->exists();

        return $isactionLogExists;
    }
}
