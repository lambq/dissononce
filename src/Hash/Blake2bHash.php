<?php

namespace Lambq\Dissononce\Hash;

class Blake2bHash extends Hash
{
    public function __construct()
    {
        parent::__construct('BLAKE2b',  64, 128);
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
