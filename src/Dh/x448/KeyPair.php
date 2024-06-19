<?php

namespace Lambq\Dissononce\Dh\x448;

use Lambq\Dissononce\Exception\NoiseProtocolException;

class KeyPair extends \Lambq\Dissononce\Dh\KeyPair
{
    public function __construct($public_key, $private_key)
    {
        parent::__construct($public_key, $private_key);
    }

    public function from_bytes($data)
    {
        if (strlen($data) != 112) {
            throw new NoiseProtocolException('noise Dh x448 from_bytes data长度(64)结果: ' . strlen($data));
        }

        return $this->__construct(new PublicKey(substr($data, 56)), new PrivateKey(substr($data, 0, 56)));
    }
}
