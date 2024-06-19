<?php

namespace Lambq\Dissononce\Processing\Impl;

class SymmetricState
{
    protected $cipherstate;
    protected $hashfn;
    protected $ck;
    protected $h;
    public function __construct($cipherstate, $hash)
    {
        $this->cipherstate  = $cipherstate;
        $this->hashfn       = $hash;
        $this->ck           = null;
        $this->h            = null;
    }

    public function ciphername()
    {
        return $this->cipherstate->cipher->name;
    }

    public function hashname()
    {
        return $this->hashfn->name;
    }

    public function cipherstate_has_key()
    {
        return $this->cipherstate->has_key();
    }

    public function initialize_symmetric($protocolname)
    {
        $lendiff = strlen($protocolname) - $this->hashfn->hashlen;

        if ($lendiff <= 0)
        {
            $this->h = $protocolname + b"\0" * abs($lendiff);
        } else {
            $this->h = $this->hashfn->hash($protocolname);
        }

        $this->ck = $this->h;
    }

    public function mix_key($input_key_material)
    {
        [$this->ck, $temp_k] = $this->hashfn->hkdf($this->ck, $input_key_material, 2);

        if ($this->hashfn->hashlen == 64)
        {
            $temp_k = substr($temp_k, 0, 32);
        }

        $this->cipherstate->initialize_key($temp_k);
    }

    public function mix_hash($data)
    {
        $this->h = $this->hashfn->hash($this->h + $data);
    }

    public function mix_key_and_hash($input_key_material)
    {
        [$this->ck, $temp_h, $temp_k] = $this->hashfn->hkdf($this->ck, $input_key_material, 3);
        $this->mix_hash($temp_h);

        if ($this->hashfn->hashlen == 64)
        {
            $temp_k = substr($temp_k, 0, 32);
        }

        $this->cipherstate->initialize_key($temp_k);
    }

    public function get_handshake_hash()
    {
        return $this->h;
    }

    public function encrypt_and_hash($plaintext)
    {
        $ciphertext = $this->cipherstate->encrypt_with_ad($this->h, $plaintext);
        $this->mix_hash($ciphertext);
        return $ciphertext;
    }

    public function decrypt_and_hash($ciphertext)
    {
        $plaintext = $this->cipherstate->decrypt_with_ad($this->h, $ciphertext);
        $this->mix_hash($ciphertext);
        return $plaintext;
    }

    public function split()
    {
        [$temp_k1, $temp_k2] = $this->hashfn->hkdf($this->ck, b"", 2);

        if ($this->hashfn.hashlen == 64)
        {
            $temp_k1 = substr($temp_k1, 0, 32);
            $temp_k2 = substr($temp_k2, 0, 32);
        }

        $c1 = new CipherState($this->cipherstate->cipher);
        $c2 = new CipherState($this->cipherstate->cipher);
        $c1->initialize_key($temp_k1);
        $c2->initialize_key($temp_k2);

        return [$c1, $c2];
    }
}
