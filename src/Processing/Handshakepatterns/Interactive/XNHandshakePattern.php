<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class XNHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('XN',  [
            ['e'],
            ['e', 'ee'],
            ['s', 'se']
        ]);
    }
}
