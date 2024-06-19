<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class I1X1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('I1X1',  [
            ['e', 's'],
            ['e', 'ee', 's'],
            ['se', 'es']
        ]);
    }
}
