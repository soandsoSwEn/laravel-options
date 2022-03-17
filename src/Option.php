<?php

namespace Soandso\LaravelOptions;

use Illuminate\Support\Facades\Facade;

class Option extends Facade
{
    public static function getFacadeAccessor() : string
    {
        return 'Option';
    }
}