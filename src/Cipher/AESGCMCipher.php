<?php

namespace Lambq\Dissononce\Cipher;

use Lambq\Dissononce\Exception\DecryptFailureException;
use Lambq\Dissononce\Exception\NoiseProtocolException;

class AESGCMCipher extends Cipher
{
    protected $byte = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
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
        $keyLength = strlen($key);
        if ($keyLength !== SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES) {
            throw new NoiseProtocolException('Key length must be %s bytes, %s bytes provided.', SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES, $keyLength);
        }

        return sodium_crypto_aead_aes256gcm_encrypt($message, $ad, $this->format_nonce($nonce), $key);
    }

    /**
     * 解密
     */
    public function decrypt($key, $nonce, $ad = null, $message)
    {
        $keyLength = strlen($key);
        if ($keyLength !== SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES) {
            throw new NoiseProtocolException('Key length must be %s bytes, %s bytes provided.', SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES, $keyLength);
        }

        $res = sodium_crypto_aead_aes256gcm_decrypt($message, $ad, $this->format_nonce($nonce), $key);

        if ($res === false) {
            throw new DecryptFailureException();
        }

        return $res;
    }

    /**
     * 设置 偏移量
     */
    public function format_nonce($n)
    {
        return parent::byteArray2str([0, 0, 0, 0]) . pack('Q', $n); // 'N' 代表无符号长整型，与Python中的'Q'兼容
    }
}
