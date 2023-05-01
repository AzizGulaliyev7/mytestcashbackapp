<?php

namespace App\Modules\Cashback\Models;

use App\Modules\Cashback\Repositories\CashbackType\CashbackTypeGroupRepository;
use App\Modules\Cashback\Repositories\CashbackType\CashbackTypeRepeatableRepository;
use App\Modules\Cashback\Repositories\CashbackType\CashbackTypeSingleRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CashbackAction extends Model
{
    use HasFactory;

    const CASHBACK_ACTION_TYPE_GROUP = 'group_acton';
    const CASHBACK_ACTION_TYPE_SINGLE = 'single_acton';
    const CASHBACK_ACTION_TYPE_REPEATABLE = 'repeatable_acton';

    public function attributes(){
        return $this->hasMany(CashbackActionAttribute::class,'cashback_action_id','id');
    }

    public function checkAttributes($attributes) {
        $caa = [];
        $a = [];
        foreach ($attributes as $attribute) {
            $caa[] = $attribute['cashback_action_attribute_id'];
            $a[$attribute['cashback_action_attribute_id']] = $attribute['value'];
        }

        $cashbackActionAttributes = CashbackActionAttribute::whereIn('id', $caa)->get();

        $allAttributes = DB::table('cashback_action_attributes')
            ->select('cashback_action_id', DB::raw('COUNT(cashback_action_attributes.id) as all_attribute_count'))
            ->whereNull('deleted_at')
            ->groupBy('cashback_action_id');

        $passedAttributes = DB::table('cashback_action_attributes')
            ->select('cashback_action_id', DB::raw('COUNT(cashback_action_attributes.id) as passed_attribute_count'))
            ->where(function($query) use ($cashbackActionAttributes, $a) {
                foreach ($cashbackActionAttributes as $cashbackActionAttribute) {
                    $query->orWhere(function ($query) use ($a, $cashbackActionAttribute) {
                        $query->where('cashback_action_attributes.id', $cashbackActionAttribute->id)
                            ->whereRaw(('?' . $cashbackActionAttribute->condition . 'cashback_action_attributes.value'), [$a[$cashbackActionAttribute->id]]);
                    });
                }
            })
            ->whereNull('deleted_at')
            ->groupBy('cashback_action_id');

        $cashbackActionAttributeExist = self::joinSub($allAttributes, 'all_attributes', function ($join) {
                $join->on('cashback_actions.id', '=', 'all_attributes.cashback_action_id');
            })
            ->joinSub($passedAttributes, 'passed_attributes', function ($join) {
                $join->on('cashback_actions.id', '=', 'passed_attributes.cashback_action_id');
            })
            ->whereRaw('all_attributes.all_attribute_count = passed_attributes.passed_attribute_count')->exists();

        return $cashbackActionAttributeExist;
    }

    public function getType() {
        $actionTypes = array(
            'group_acton' => CashbackTypeGroupRepository::class,
            'single_acton' => CashbackTypeSingleRepository::class,
            'repeatable_acton' => CashbackTypeRepeatableRepository::class
        );

        return app()->make($actionTypes[$this->type]);
    }
}
