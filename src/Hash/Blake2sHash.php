<?php

namespace Lambq\Dissononce\Hash;

class Blake2sHash extends Hash
{
    public function __construct()
    {
        parent::__construct('BLAKE2s',  32, 64);
    }

    public function hash($data)
    {
        parent::blake($data);
    }

    public function hmac_hash($key, $data)
    {
        parent::hmac_blake($key, $data);
    }
}
