<?php

declare(strict_types=1);

namespace App\Modules\Cashback\Procedures;

use App\Modules\Cashback\Repositories\CashbackAble\Interfaces\CashbackAbleRepositoryInterface;
use App\Modules\Cashback\Requests\CashbackRequest;
use Illuminate\Http\Request;
use Modules\Balance\DTO\CreateBalanceDTO;
use Sajya\Server\Procedure;

class CashbackProcedure extends Procedure
{
    /**
     * The name of the procedure that will be
     * displayed and taken into account in the search
     *
     * @var string
     */
    public static string $name = 'CashbackForCustomer';
    private $cashbackAbleRepository;

    public function __construct(CashbackAbleRepositoryInterface $cashbackAbleRepository) {
        $this->cashbackAbleRepository = $cashbackAbleRepository;
    }

    /**
     * Execute the procedure.
     *
     * @param Request $request
     *
     * @return array|string|integer
     */
    public function cashback(CashbackRequest $request)
    {
        try {
            $response = $this->cashbackAbleRepository->cashback($request);
            return $response;
        } catch (\Exception $e) {
            return response()->internalServerError('Internal Server Error.', $e->getMessage());
        }
    }
}









