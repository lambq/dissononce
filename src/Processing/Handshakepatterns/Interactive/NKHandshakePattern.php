<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class NKHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('NK',  [
            ['e', 'es'],
            ['e', 'ee'],
        ],null, ['s']);
    }
}
