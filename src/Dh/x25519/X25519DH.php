<?php

namespace Lambq\Dissononce\Dh\x25519;

use Lambq\Dissononce\Exception\NoiseProtocolException;
use Lambq\Dissononce\Dh\KeyPair;
use Lambq\Dissononce\Dh\Dh;

class X25519DH extends Dh
{
    public function __construct()
    {
        parent::__construct('25519', 32);
    }

    public function dh($keypair, $publickey)
    {
        return parent::dh($keypair, $publickey);
    }

    public function create_public($data)
    {
        return parent::create_public($data);
    }

    public function generateKeyPair($privatekey = null): KeyPair
    {
        if ($privatekey == '') {
            $private = random_bytes($this->getLen());
        } else {
            // 将字节串转换为PHP可以处理的格式
            $private = sodium_base642bin($privatekey);
        }

        $publicKey = sodium_crypto_scalarmult_base($private);

        return new KeyPair(
            $publicKey,
            $private
        );
    }

    public function __toString(): string
    {
        return '25519';
    }
}
