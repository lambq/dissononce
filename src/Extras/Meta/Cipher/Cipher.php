<?php

namespace Lambq\Dissononce\Extras\Meta\Cipher;

use Lambq\Dissononce\Cipher\AESGCMCipher;
use Lambq\Dissononce\Cipher\ChaChaPolyCipher;

class Cipher
{
    protected $NAME_CIPHER_AESGCM = 'AESGCM';
    protected $NAME_CIPHER_CHACHAPOLY = 'ChaChaPoly';
    protected $MAP_CIPHER;
    public function __construct()
    {
        $this->MAP_CIPHER = [
            'NAME_CIPHER_AESGCM'        => new AESGCMCipher(),
            'NAME_CIPHER_CHACHAPOLY'    => new ChaChaPolyCipher(),
        ];
    }

    public function getMapCipher()
    {
        return $this->MAP_CIPHER;
    }
}
