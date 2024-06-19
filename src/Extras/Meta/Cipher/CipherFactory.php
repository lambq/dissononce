<?php

namespace Lambq\Dissononce\Extras\Meta\Cipher;

use Lambq\Dissononce\Exception\NoiseProtocolException;

class CipherFactory extends Cipher
{
    public function get_cipher($name)
    {
        if (array_key_exists($name, parent::getMapCipher()))
        {
            return parent::getMapCipher()[$name]();
        }

        throw new NoiseProtocolException("Lambq Dissononce Extras Meta Cipher CipherFactory cipher: {$name}");
    }
}
