<?php

namespace Lambq\Dissononce\Extras\Meta\Protocol;

use Lambq\Dissononce\Dh\Dh;
use Lambq\Dissononce\Cipher\Cipher;
use Lambq\Dissononce\Hash\Hash;
use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;
use Lambq\Dissononce\Processing\Impl\HandshakeState;
use Lambq\Dissononce\Processing\Impl\SymmetricState;
use Lambq\Dissononce\Processing\Impl\CipherState;


class NoiseProtocol
{
    protected $pattern;
    protected $dh;
    protected $cipher;
    protected $hash;
    protected $oneway;
    public function __construct(HandshakePattern $pattern, Dh $dh, Cipher $cipher, Hash $hash)
    {
        $this->pattern  = $pattern;  # type: HandshakePattern
        $name           = $pattern->parse_handshakepattern($pattern->name())[0];
        $this->dh       = $dh;  # type: DH
        $this->cipher   = $cipher;  # type: Cipher
        $this->hash     = $hash;  # type: Hash
        $this->oneway   = count($name) == 1; # type: bool
    }

    public function oneway()
    {
        return $this->oneway;
    }

    public function pattern()
    {
        return $this->pattern;
    }

    public function dh()
    {
        return $this->dh;
    }

    public function cipher()
    {
        return $this->cipher;
    }

    public function hash()
    {
        return $this->hash;
    }

    public function create_cipherstate($cipher = null)
    {
        $cipher = $cipher != null ? $cipher : $this->cipher;
        return new CipherState($cipher);
    }

    public function create_symmetricstate($cipherstate = null, $hash = null)
    {
        $cipherstate    = $cipherstate != null ? $cipherstate : $this->create_cipherstate();
        $hash           = $hash != null ? $hash : $this->hash;
        return new SymmetricState($cipherstate, $hash);
    }

    public function create_handshakestate($symmetricstate = null, $dh = null)
    {
        $symmetricstate = $symmetricstate != null ? $symmetricstate : $this->create_symmetricstate();
        $dh             = $dh != null ? $dh : $this->dh;
        return new HandshakeState($symmetricstate, $dh);
    }
}
