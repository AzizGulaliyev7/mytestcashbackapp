<?php

namespace App\Modules\Cashback\Repositories\CashbackAble;

use App\Modules\Cashback\Repositories\CashbackAble\Interfaces\CashbackAbleRepositoryInterface;
use App\Modules\Cashback\Repositories\CashbackType\Interfaces\CashbackActionProcessInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CashbackActionRepository implements CashbackAbleRepositoryInterface
{
    private $cashbackActionProcess;

    public function __construct(CashbackActionProcessInterface $cashbackActionProcess) {
        $this->cashbackActionProcess = $cashbackActionProcess;
    }

    public function cashback(Request $request) : JsonResponse
    {
        return $this->cashbackActionProcess->processCashbackAction($request);
    }
}

