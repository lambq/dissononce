<?php

namespace Lambq\Dissononce\Extras\Meta\Hash;

use Lambq\Dissononce\Hash\SHA256Hash;
use Lambq\Dissononce\Hash\SHA512Hash;
use Lambq\Dissononce\Hash\Blake2sHash;
use Lambq\Dissononce\Hash\Blake2bHash;

class Hash
{
    protected $NAME_SHA256 = 'SHA256';
    protected $NAME_SHA512 = 'SHA512';
    protected $NAME_BLAKE2S = 'BLAKE2s';
    protected $NAME_BLAKE2B = 'BLAKE2b';
    protected $MAP_HASH;

    public function __construct()
    {
        $this->MAP_HASH = [
            'NAME_SHA256'   => new SHA256Hash(),
            'NAME_SHA512'   => new SHA512Hash(),
            'NAME_BLAKE2S'  => new Blake2sHash(),
            'NAME_BLAKE2B'  => new Blake2bHash(),
        ];
    }

    public function getMapHash()
    {
        return $this->MAP_HASH;
    }
}
