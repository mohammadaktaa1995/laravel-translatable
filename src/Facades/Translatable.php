<?php

namespace Aktaa\translatable\Facades;

use Illuminate\Support\Facades\Facade;

class Translatable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Translatable';
    }
}
