<?php

namespace Lambq\Dissononce\Dh\x25519;

class PublicKey extends \Lambq\Dissononce\Dh\PublicKey
{
    public function __construct($data)
    {
        parent::__construct(32, $data);
    }
}
