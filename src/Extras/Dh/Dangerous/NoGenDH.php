<?php

namespace Lambq\Dissononce\Extras\Dh\Dangerous;

use Lambq\Dissononce\Dh\Dh;

class NoGenDH extends Dh
{
    public function __construct($dh, $privatekey)
    {
        parent::__construct($dh->name() , $dh->dhlen());
        $this->dh           = $dh;
        $this->privatekey   = $privatekey;
    }

    public function dh($keypair, $publickey)
    {
        return parent::dh($keypair, $publickey);
    }

    public function create_public($data)
    {
        return parent::create_public($data);
    }

    public function generate_keypair($privatekey = null)
    {
        $private = $privatekey != null ? $privatekey : $this->privatekey;
        return parent::generateKeyPair($private);
    }
}