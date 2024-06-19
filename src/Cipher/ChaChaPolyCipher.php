<?php

namespace Lambq\Dissononce\Cipher;

// 生成一个密钥，这个密钥是私钥
//$key = sodium_crypto_aead_chacha20poly1305_keygen();

// 要加密的数据
//$plaintext = "Hello, Secret!";

// 生成随机的非密态加密向量（IV）
//$nonce = random_bytes(sodium_crypto_aead_chacha20poly1305_ietf_NPUBBYTES);

// 加密数据
//$ciphertext = sodium_crypto_aead_chacha20poly1305_encrypt($plaintext, $nonce, $key);

// 解密数据
//$decrypted = sodium_crypto_aead_chacha20poly1305_decrypt($ciphertext, $nonce, $key);

// 输出解密后的数据
//echo $decrypted; // 输出 "Hello, Secret!"
use Lambq\Dissononce\Exception\DecryptFailedException;
use Lambq\Dissononce\Exception\DecryptFailureException;
use Lambq\Dissononce\Exception\NoiseProtocolException;

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
        $keyLength = strlen($key);
        if ($keyLength !== SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_KEYBYTES) {
            throw new NoiseProtocolException('Key length must be %s bytes, %s bytes provided.', SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES, $keyLength);
        }

        return sodium_crypto_aead_chacha20poly1305_encrypt($message, $ad, $this->format_nonce($nonce), $key);
    }

    /**
     * 解密
     */
    public function decrypt($key, $nonce, $ad = null, $message)
    {
        $keyLength = strlen($key);
        if ($keyLength !== SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_KEYBYTES) {
            throw new NoiseProtocolException('Key length must be %s bytes, %s bytes provided.', SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES, $keyLength);
        }

        $res = sodium_crypto_aead_chacha20poly1305_decrypt($message, $ad, $this->format_nonce($nonce), $key);

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
