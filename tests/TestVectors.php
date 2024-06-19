<?php

namespace Lambq\Dissononce\tests;

use Lambq\Dissononce\Extras\Meta\Protocol\NoiseProtocol;
use Lambq\Dissononce\Extras\Meta\Protocol\NoiseProtocolFactory;
use Lambq\Dissononce\Dh\PrivateKey;
use Lambq\Dissononce\Extras\Dh\Dangerous\NoGenDH;



//from tests.structs.vector import Vector, VectorVars, VectorMessage

class TestVectors
{
    public function __construct($pattern, $dh, $cipher, $hash)
    {
        $this->pattern  = $pattern;  # type: HandshakePattern
        $this->dh       = $dh;  # type: DH
        $this->cipher   = $cipher;  # type: Cipher
        $this->hash     = $hash;  # type: Hash
        $this->oneway   = count($handshakePattern->parse_handshakepattern($pattern->name())[0]) == 1;  # type: bool
    }

}