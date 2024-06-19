<?php

namespace Lambq\Dissononce\Extras\Meta\Modifier;

use Lambq\Dissononce\Exception\NoiseProtocolException;

class ModifierFactory extends Modifier
{

    public function get_modifier($name)
    {
        if (array_key_exists($name, parent::getMapModifier()))
        {
            return parent::getMapModifier()[$name]();
        }

        throw new NoiseProtocolException("Lambq Dissononce Extras Meta Modifier ModifierFactory get_modifier: {$name}");
    }
}
