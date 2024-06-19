<?php

namespace Lambq\Dissononce\Processing\Impl;

use Lambq\Dissononce\Cipher\Cipher;

class CipherState
{
    protected $cipher;
    protected $key;
    protected $nonce;
    public function __construct(cipher $cipher)
    {
        $this->cipher   = $cipher;
        $this->key      = null;
        $this->nonce    = 0;
    }

    public function cipher()
    {
        $this->cipher;
    }

    public function initialize_key($key)
    {
        $this->key      = $key;
        $this->set_nonce(0);
    }

    public function has_key()
    {
        return $this->key ? $this->key : null;
    }

    public function set_nonce($nonce)
    {
        return $this->nonce = $nonce;
    }

    public function rekey()
    {
        $this->key = $this->cipher->rekey($this->key);
    }

    public function encrypt_with_ad($ad, $plaintext)
    {
        if (!isset($this->key))
        {
            return $plaintext;
        }

        $result = $this->cipher->encrypt($this->key, $this->nonce, $ad, $plaintext);
        $this->nonce += 1;
        return $result;
    }

    public function decrypt_with_ad($ad, $plaintext)
    {
        if (!isset($this->key))
        {
            return $plaintext;
        }

        $result = $this->cipher->decrypt($this->key, $this->nonce, $ad, $plaintext);
        $this->nonce += 1;
        return $result;
    }
}
