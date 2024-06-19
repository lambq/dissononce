<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns\Deferred;

use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;

class XX1HandshakePattern extends HandshakePattern
{
    public function __construct()
    {
        parent::__construct('XX1',  [
            ['e'],
            ['e', 'ee', 's'],
            ['es', 's', 'se']
        ]);
    }
}