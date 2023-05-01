<?php

namespace App\Repositories\CashbackAble;

use App\Modules\Cashback\Repositories\CashbackAble\Interfaces\CashbackAbleRepositoryInterface;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\CashbackActionProcessInterface;
use Illuminate\Http\Request;

class CashbackActionRepository implements CashbackAbleRepositoryInterface
{
    private $cashbackActionProcess;

    public function __construct(CashbackActionProcessInterface $cashbackActionProcess) {
        $this->cashbackActionProcess = $cashbackActionProcess;
    }

    public function cashback(Request $request) : array
    {
        return $this->cashbackActionProcess->processCashbackAction($request);
    }
}

