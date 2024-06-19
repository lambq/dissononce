<?php

namespace Lambq\Dissononce\Hash;

class SHA256Hash extends Hash
{
    public function __construct()
    {
        parent::__construct('SHA256', 32, 64);
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
