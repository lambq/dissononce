<?php

namespace Lambq\Dissononce\Extras\Meta\Hash;

use Lambq\Dissononce\Exception\NoiseProtocolException;

class HashFactory extends Hash
{
    public function get_hash($name)
    {
        if (array_key_exists($name, parent::getMapHash()))
        {
            return parent::getMapHash()[$name]();
        }

        throw new NoiseProtocolException("Lambq Dissononce Extras Meta Hash HashFactory Hash: {$name}");
    }
}
