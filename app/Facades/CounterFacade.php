<?php

namespace App\Facades;

use App\Contracts\CounterContract;
use Illuminate\Support\Facades\Facade;

class CounterFacade extends Facade
{

    /**
     * A facade to contract
     * @method static increment(string $key, array $tags = null): int
     *
     */
    public static function getFacadeAccessor()
    {
            return CounterContract::class;
    }
}
