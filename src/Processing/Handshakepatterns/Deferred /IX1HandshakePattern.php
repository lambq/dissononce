<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class IX1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('IX1',  [
            ['e', 's'],
            ['e', 'ee', 'se', 's'],
            ['se']
        ]);
    }
}
