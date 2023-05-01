<?php

namespace App\Modules\Cashback\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CashbackActionGroup extends Model
{
    use HasFactory;

    public function action(){
        return $this->hasMany(CashbackAction::class,'cashback_action_group_id','id');
    }

    public function isAllActionsDone() {
        $allCashbackActions = DB::table('cashback_actions')
            ->select('cashback_action_group_id', DB::raw('COUNT(cashback_actions.id) as all_actions_count'))
            ->where('type', CashbackAction::CASHBACK_ACTION_TYPE_GROUP)
            ->whereNull('deleted_at')
            ->groupBy('cashback_action_group_id');

        $loggedCashbackActions = DB::table('cashback_actions')
            ->select('cashback_actions.cashback_action_group_id', DB::raw('COUNT(cashback_actions.id) as logged_actions_count'))
            ->join('cashback_action_logs', function ($join) {
                $join->on('cashback_actions.id', '=', 'cashback_action_logs.cashback_action_id')
                    ->where('cashback_action_logs.status', 1)
                    ->whereNull('cashback_action_logs.deleted_at');
            })
            ->where('cashback_actions.type', CashbackAction::CASHBACK_ACTION_TYPE_GROUP)
            ->whereNull('cashback_actions.deleted_at')
            ->groupBy('cashback_actions.cashback_action_group_id');

        $cashbackActionGroupExist = self::joinSub($allCashbackActions, 'all_actions', function ($join) {
                $join->on('cashback_action_groups.id', '=', 'all_actions.cashback_action_group_id');
            })
            ->joinSub($loggedCashbackActions, 'logged_actions', function ($join) {
                $join->on('cashback_action_groups.id', '=', 'logged_actions.cashback_action_group_id');
            })
            ->whereRaw('all_actions.all_actions_count = logged_actions.logged_actions_count')->exists();

        return $cashbackActionGroupExist;
    }
}
