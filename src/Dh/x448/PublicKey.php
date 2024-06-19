<?php

namespace Lambq\Dissononce\Dh\x448;

class PublicKey extends \Lambq\Dissononce\Dh\PublicKey
{
    public function __construct($data)
    {
        parent::__construct(56, $data);
    }
}
