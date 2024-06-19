<?php

namespace Lambq\Dissononce\Extras\Meta\Dh;

//from dissononce.dh.x25519.x25519 import X25519DH
//from dissononce.dh.x448.x448 import X448DH
//
//NAME_DH_25519 = '25519'
//NAME_DH_448 = '448'
//
//MAP_DH = {
//    NAME_DH_25519: X25519DH,
//    NAME_DH_448: X448DH
//}
use Lambq\Dissononce\Dh\x25519\X25519DH;
use Lambq\Dissononce\Dh\x448\X448DH;

class Dh
{

    protected $NAME_DH_25519 = '25519';
    protected $NAME_DH_448 = '448';

    protected $MAP_DH;

    public function __construct()
    {
        $this->MAP_DH = [
            'NAME_DH_25519' => new X25519DH(),
            'NAME_DH_448'   => new X448DH(),
        ];
    }

    public function getMapDh()
    {
        return $this->MAP_DH;
    }
}
