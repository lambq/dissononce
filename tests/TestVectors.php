<?php

namespace Lambq\Dissononce\tests;

use Lambq\Dissononce\Extras\Meta\Protocol\NoiseProtocol;
use Lambq\Dissononce\Extras\Meta\Protocol\NoiseProtocolFactory;
use Lambq\Dissononce\Dh\PrivateKey;
use Lambq\Dissononce\Hash\Hash;
use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;
use Lambq\Dissononce\Processing\Impl\HandshakeState;
use Lambq\Dissononce\Processing\Impl\SymmetricState;
use Lambq\Dissononce\Processing\Impl\CipherState;

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