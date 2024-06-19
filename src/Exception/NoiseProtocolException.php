<?php

namespace Lambq\Dissononce\Exception;

use Exception;

class NoiseProtocolException extends Exception
{
    public function __construct($message = "", ...$params)
    {
        parent::__construct(sprintf($message, ...$params));
    }
}
