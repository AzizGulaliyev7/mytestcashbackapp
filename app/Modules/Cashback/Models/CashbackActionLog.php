<?php

namespace App\Modules\Cashback\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashbackActionLog extends Model
{
    use HasFactory;

    protected $fillable = ['cashback_action_id', 'user_id', 'status'];
}
