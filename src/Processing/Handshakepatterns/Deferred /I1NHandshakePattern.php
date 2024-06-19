<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class I1NHandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('I1N',  [
            ['e', 's'],
            ['e', 'ee'],
            ['se']
        ]);
    }
}
