<?php

namespace Lambq\Dissononce\Extras\Meta\Protocol;

use Lambq\Dissononce\Extras\Meta\Modifier\ModifierFactory;
use Lambq\Dissononce\Extras\Meta\Hash\HashFactory;
use Lambq\Dissononce\Extras\Meta\Cipher\CipherFactory;
use Lambq\Dissononce\Extras\Meta\Dh\DHFactory;
use Lambq\Dissononce\Extras\Meta\Pattern\PatternFactory;
use Lambq\Dissononce\Extras\Meta\Protocol\NoiseProtocol;
use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class NoiseProtocolFactory
{
    public function __construct()
    {
        $this->dh_factory       = new DHFactory();
        $this->cipher_factory   = new CipherFactory();
        $this->hash_factory     = new HashFactory();
        $this->modifier_factory = new ModifierFactory();
        $this->pattern_factory  = new PatternFactory();
    }

    public function get_noise_protocol($name)
    {
        $handshakePattern   = new HandshakePattern();
        [$null, $handshake, $dh, $cipher, $hash] = explode("_", $name);
        [$handshake_patternname, $modifiers] = $handshakePattern->parse_handshakepattern($handshake);

        $pattern = $this->pattern_factory->get_pattern($handshake_patternname);

        foreach ($modifiers as $modifier)
        {
            $pattern = $this->modifier_factory->get_modifier($modifier)->modify($pattern);
        }

        return new NoiseProtocol($pattern, $this->dh_factory->get_dh($dh), $this->cipher_factory->get_cipher($cipher), $this->hash_factory->get_hash($hash));
    }
}
