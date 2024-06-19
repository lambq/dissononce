<?php

namespace Lambq\Dissononce\Dh;

use Lambq\Dissononce\Dh\PublicKey;

class Dh
{
    public $name;
    public $dhlen;

    public function __construct(string $name, string $dhlen)
    {
        $this->name     = $name;
        $this->dhlen    = $dhlen;
    }

    public function name()
    {
        return $this->name;
    }

    public function dhlen()
    {
        return $this->dhlen;
    }

    public function generate_keypair($privatekey)
    {

    }

    public function create_public($data)
    {
        return new PublicKey($this->dhlen, $data);
    }

    public  function dh(KeyPair $keypair, PublicKey $publickey)
    {

    }
}