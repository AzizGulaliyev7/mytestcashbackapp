<?php

Route::rpc('/cashback', [\App\Modules\Cashback\Procedures\CashbackProcedure::class])->name('rpc.cashback');

