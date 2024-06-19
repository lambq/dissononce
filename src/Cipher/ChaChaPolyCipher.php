<?php

namespace Lambq\Dissononce\Cipher;

//from dissononce.cipher.cipher import Cipher
//from dissononce.exceptions.decrypt import DecryptFailedException
//
//import struct
//from cryptography.hazmat.primitives.ciphers.aead import ChaCha20Poly1305
//from cryptography.exceptions import InvalidTag
use Lambq\Dissononce\Exception\DecryptFailedException;

class ChaChaPolyCipher extends Cipher
{
    public function __construct()
    {
        parent::__construct('ChaChaPoly');
    }

    /**
     * 加密
     */
    public function encrypt($key, $nonce,  $ad = null, $message)
    {
        return parent::encrypt($key, $this->format_nonce($nonce),  $ad, $message);
    }

    /**
     * 解密
     */
    public function decrypt($key, $nonce, $ad = null, $message)
    {
        return parent::decrypt($key, $this->format_nonce($nonce),  $ad, $message);
    }

    /**
     * 设置 偏移量
     */
    public function format_nonce($n)
    {
        return parent::byteArray2str([0, 0, 0, 0]) . pack('Q', $n); // 'N' 代表无符号长整型，与Python中的'Q'兼容
    }
}
