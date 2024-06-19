<?php

namespace Lambq\Dissononce\Hash;

class SHA512Hash extends Hash
{
    public function __construct()
    {
        parent::__construct('SHA512', 64, 128);
    }

    public function hash($data)
    {
        return parent::hash($data);
    }

    public function hmac_hash($key, $data)
    {
        return parent::hmac_hash($key, $data);
    }
}
