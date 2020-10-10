<?php

namespace LaravelCode\AMPQ\Facades;

use Illuminate\Support\Facades\Facade;

class Consumer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Consumer';
    }
}
