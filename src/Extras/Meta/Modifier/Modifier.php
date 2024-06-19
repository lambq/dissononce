<?php

namespace Lambq\Dissononce\Extras\Meta\Modifier;

use Lambq\Dissononce\Processing\Modifiers\PSKPatternModifier;
use Lambq\Dissononce\Processing\Modifiers\FallbackPatternModifier;

class Modifier
{
    protected $NAME_MODIFIER_psk0 = 'psk0';
    protected $NAME_MODIFIER_psk1 = 'psk1';
    protected $NAME_MODIFIER_psk2 = 'psk2';
    protected $NAME_MODIFIER_psk3 = 'psk3';
    protected $NAME_MODIFIER_FALLBACK = 'fallback';

    protected $MAP_MODIFIER;


    public function __construct()
    {
        $this->MAP_MODIFIER = [
            'NAME_MODIFIER_psk0'    => new PSKPatternModifier(0),
            'NAME_MODIFIER_psk1'    => new PSKPatternModifier(1),
            'NAME_MODIFIER_psk2'    => new PSKPatternModifier(2),
            'NAME_MODIFIER_psk3'    => new PSKPatternModifier(3),
            'NAME_MODIFIER_FALLBACK'    => new FallbackPatternModifier(),
        ];
    }

    public function getMapModifier()
    {
        return $this->MAP_MODIFIER;
    }
}
