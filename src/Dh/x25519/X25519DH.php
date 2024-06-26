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

    public function dh(KeyPair $keypair, $publickey)
    {
        return sodium_crypto_scalarmult($keypair->private(), $publickey->data());
    }

    public function create_public($data)
    {
        return new PublicKey($data);
    }

    public function generate_keypair($privatekey = null)
    {
        if ($privatekey == '' || $privatekey == null) {
            $private = random_bytes(32);
        } else {
            // 将字节串转换为PHP可以处理的格式
            $private = sodium_base642bin($privatekey);
        }

        $publicKey = sodium_crypto_scalarmult_base($private);

        return new KeyPair(
            new PublicKey($publicKey),
            new PrivateKey($private)
        );
    }
}
