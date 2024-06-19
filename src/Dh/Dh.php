<?php

namespace Lambq\Dissononce\Dh;

use Lambq\Dissononce\Dh\PublicKey;

class Dh
{
    public $name;
    public $dhlen;

    public function __construct(string $name, string $dhlen)
    {
        $this->name = $name;
        $this->dhlen = $dhlen;
    }

    public function name()
    {
        return $this->name;
    }

    public function dhlen()
    {
        return $this->dhlen;
    }

    public function getLen(): int
    {
        return SODIUM_CRYPTO_SCALARMULT_SCALARBYTES;
    }

    public function generateKeyPair($privatekey)
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

    public function create_public($data)
    {
        return new PublicKey($this->dhlen, $data);
    }

    public  function dh(KeyPair $keypair, PublicKey $publickey)
    {
        return sodium_crypto_scalarmult($keypair->private(), $publickey->data());
    }
}