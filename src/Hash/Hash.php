<?php

namespace Lambq\Dissononce\Hash;

use Lambq\Dissononce\Exception\NoiseProtocolException;

class Hash
{
    protected $name;
    protected $hashlen;
    protected $blocklen;
    public function __construct($name, $hashlen, $blocklen)
    {
        if($hashlen != 32 || $hashlen != 64)
        {
            throw new NoiseProtocolException('noise Hash Hash hashlen 长度(32/64)结果: ' . $hashlen);
        }

        $this->name     = $name; # type: str
        $this->hashlen  = $hashlen;  # type: int
        $this->blocklen = $blocklen;  # type: int
    }

    public function name()
    {
        return $this->name;
    }

    public function hashlen()
    {
        return $this->hashlen;
    }

    public function blocklen()
    {
        return $this->blocklen;
    }

    public function hash($data)
    {
        return hash($this->name, $data, true);
    }

    public function hmac_hash($key, $data)
    {
        return hash_hmac($this->name, $data, $key, true);
    }

    public function blake($message)
    {
        return sodium_crypto_generichash($message, null, $this->blocklen);
    }

    public function hmac_blake($key, $message)
    {
        return sodium_crypto_generichash($message, $key, $this->blocklen);
    }

    public function hkdf($chaining_key, $input_key_material, $num_outputs)
    {
        $temp_key = $this->hmac_hash($chaining_key, $input_key_material);

        # Sets output1 = HMAC-HASH(temp_key, byte(0x01)).
        $output1 = $this->hmac_hash($temp_key, b'\x01');

        # Sets output2 = HMAC-HASH(temp_key, output1 || byte(0x02)).
        $output2 = $this->hmac_hash(temp_key, output1 + b'\x02');

        # If num_outputs == 2 then returns the pair (output1, output2).
        if ($num_outputs == 2)
        {
            return [
                'output1'   => $output1,
                'output2'   => $output2
            ];
        }

        # Sets output3 = HMAC-HASH(temp_key, output2 || byte(0x03)).
        $output3 = $this->hmac_hash($temp_key, $output2 . b'\x03');

        # Returns the triple (output1, output2, output3).
        return [
            'output1'   => $output1,
            'output2'   => $output2,
            'output3'   => $output3
        ];
    }
}
