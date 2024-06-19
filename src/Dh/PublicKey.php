<?php

namespace Lambq\Dissononce\Dh;

use Lambq\Dissononce\Exception\NoiseProtocolException;

class PublicKey
{
    protected $data;
    public function __construct($keylen, $data)
    {
        if (strlen($data) != $keylen)
        {
            throw new NoiseProtocolException('noise Dh publickey key长度('. $keylen.')结果: ' . strlen($data));
        }

        $this->data  = $data;
    }

    public function data()
    {
        return $this->data;
    }
}
