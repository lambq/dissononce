<?php

namespace Lambq\Dissononce\Exception;

class DecryptFailedException
{
    protected $REASON_INVALID_TAG   = 0;

    public function __construct($reason)
    {
        $this->reason = $reason;
    }

    public function reason()
    {
        return $this->reason;
    }
}