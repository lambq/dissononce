<?php

namespace Lambq\Dissononce\Dh\x448;

use Lambq\Dissononce\Exception\NoiseProtocolException;
use Lambq\Dissononce\Dh\KeyPair;
use Lambq\Dissononce\Dh\Dh;

class X448DH extends Dh
{
    public function __construct()
    {
        parent::__construct('448', 56);
    }

    public function dh(KeyPair $keypair, $publickey)
    {
        return sodium_crypto_scalarmult($keypair->private(), $publickey->data());
    }

    public function create_public($data)
    {
        return new PublicKey($data);
    }

    public function generate_keypair($privatekey = null): KeyPair
    {
        if ($privatekey == '' || $privatekey == null) {
            $private = random_bytes(56);
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
