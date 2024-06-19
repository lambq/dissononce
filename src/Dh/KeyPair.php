<?php

namespace Lambq\Dissononce\Dh;

class KeyPair
{
    protected $public_key;
    protected $private_key;
    public function __construct(PublicKey $public_key, PrivateKey $private_key)
    {
        $this->public_key   = $public_key;
        $this->private_key  = $private_key;
    }

    public function public()
    {
        return $this->public_key;
    }

    public function private()
    {
        return $this->private_key;
    }
}
