<?php

namespace Lambq\Dissononce\Cipher;

class AESGCMCipher extends Cipher
{
    protected $nonce;
    public function __construct()
    {
        parent::__construct('AESGCM');
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
