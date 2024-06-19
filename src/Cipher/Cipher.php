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
        $keyLength = strlen($key);
        if ($keyLength !== SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES) {
            throw new NoiseProtocolException('Key length must be %s bytes, %s bytes provided.', SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES, $keyLength);
        }

        return sodium_crypto_aead_aes256gcm_encrypt($message, $ad, $nonce, $key);
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

        $res = sodium_crypto_aead_aes256gcm_decrypt($message, $ad, $nonce, $key);

        if ($res === false) {
            throw new DecryptFailureException();
        }

        return $res;
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