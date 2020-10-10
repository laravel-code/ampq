<?php

namespace LaravelCode\AMPQ\Facades;

use Illuminate\Support\Facades\Facade;

class Connector extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Connector';
    }
}
