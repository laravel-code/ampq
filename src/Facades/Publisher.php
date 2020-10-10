<?php

namespace LaravelCode\AMPQ\Facades;

use Illuminate\Support\Facades\Facade;

class Publisher extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaravelCode\AMPQ\Publisher::class;
    }
}
