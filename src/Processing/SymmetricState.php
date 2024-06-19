<?php

namespace Lambq\Dissononce\Processing;

use Lambq\Dissononce\Processing\Impl\SymmetricState as ImplSymmetricState;

class SymmetricState
{
    protected $symmetric;
    public function __construct()
    {
        $this->symmetric  = new ImplSymmetricState();
    }

    public function ciphername()
    {
        return null;
    }

    public function hashname()
    {
        return null;
    }

    public function cipherstate_has_key()
    {
        return $this->symmetric->cipherstate_has_key();
    }

    public function initialize_symmetric($protocolname)
    {
        return $this->symmetric->initialize_symmetric($protocolname);
    }

    public function mix_key($data)
    {
        return $this->symmetric->mix_key($data);
    }

    public function mix_hash($data)
    {
        return $this->symmetric->mix_hash($data);
    }

    public function mix_key_and_hash($input_key_material)
    {
        return $this->symmetric->mix_key_and_hash($input_key_material);
    }

    public function get_handshake_hash()
    {
        return $this->symmetric->get_handshake_hash();
    }

    public function encrypt_and_hash($plaintext)
    {
        return $this->symmetric->encrypt_and_hash($plaintext);
    }

    public function decrypt_and_hash($ciphertext)
    {
        return $this->symmetric->decrypt_and_hash($ciphertext);
    }

    public function split()
    {
        return $this->symmetric->split();
    }
}
