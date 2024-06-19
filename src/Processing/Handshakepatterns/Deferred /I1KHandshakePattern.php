<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class I1KHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('I1K',  [
            ['e', 'es', 's'],
            ['e', 'ee'],
            ['se']
        ], null, ['s']);
    }
}
