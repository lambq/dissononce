<?php

namespace Lambq\Dissononce\Cipher;

use Lambq\Dissononce\Exception\NoiseProtocolException;
use Lambq\Dissononce\Exception\DecryptFailureException;

class Cipher
{
    protected $byte = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    protected $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function name()
    {
        return $this->name;
    }
    /**
     * 加密
     */
    public function encrypt($key, $nonce,  $ad = null, $message)
    {

    }
    /**
     * 解密
     */
    public function decrypt($key, $nonce, $ad = null, $message)
    {

    }

    public function rekey($key)
    {
        return substr($this->encrypt($key, 2**64 - 1, null, $this->byteArray2str($this->byte)),0, 32);
    }

    public function byteArray2str($bytes)
    {
        return join(array_map("chr", $bytes));
    }
}