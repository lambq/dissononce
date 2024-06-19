<?php

namespace Lambq\Dissononce\Extras\Meta\Dh;

use Lambq\Dissononce\Exception\NoiseProtocolException;

class DHFactory extends Dh
{
    public function get_dh($name)
    {
        if (array_key_exists($name, parent::getMapDh()))
        {
            return parent::getMapDh()[$name]();
        }

        throw new NoiseProtocolException("Lambq Dissononce Extras Meta Dh DHFactory DH: {$name}");
    }
}
