<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Interactive;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class NNHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('NN',  [
            ['e'],
            ['e', 'ee']
        ]);
    }
}
