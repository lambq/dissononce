<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns;

class Format
{
    public static function getTemplate($name, $patterns, $template) {
        $patterns_format = implode(", ", $patterns);
        return str_replace(
            ['{name}', '{patterns}'],
            [$name, $patterns_format],
            $template
        );
    }

    public static function getAppend($patterns, $template)
    {
        return str_replace('{tokens}', implode(', ', $patterns), $template);
    }

    public static function deriveProtocolName($handshake, $dh, $cipher, $hash, $template)
    {
        return str_replace(
            ['{handshake}', '{dh}', '{cipher}', '{hash}'],
            [$handshake, $dh, $cipher, $hash],
            $template
        );
    }
}
