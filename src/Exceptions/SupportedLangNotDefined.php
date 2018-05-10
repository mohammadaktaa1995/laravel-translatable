<?php

namespace Aktaa\translatable\Exceptions;

use Exception;

class SupportedLangNotDefined extends Exception
{
    public function __construct()
    {
        parent::__construct('Supported locales must be defined.');
    }
}
