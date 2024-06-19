<?php

namespace Lambq\Dissononce\Extras\Meta\Pattern;

use Lambq\Dissononce\Exception\NoiseProtocolException;

class PatternFactory extends Pattern
{
    public function get_pattern($name)
    {
        if (array_key_exists($name, parent::getMapPATTERN()))
        {
            return parent::getMapPATTERN()[$name]();
        }

        throw new NoiseProtocolException("Lambq Dissononce Extras Meta Pattern PatternFactory get_pattern: {$name}");
    }
}
