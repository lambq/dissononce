<?php

namespace Lambq\Dissononce\Dh;

use Lambq\Dissononce\Exception\NoiseProtocolException;

class PrivateKey
{
    protected $data;
    public function __construct($data)
    {
        $this->data  = $data;
    }

    public function data()
    {
        return $this->data;
    }
}
