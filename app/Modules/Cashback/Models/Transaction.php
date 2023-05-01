<?php

namespace App\Modules\Cashback\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['balance_account_id', 'cashback_action_id', 'cashback_amount', 'debit'];
}
