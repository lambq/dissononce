<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns;

class StrTool
{
    public static function format($string) {
        $args = func_get_args();
        array_shift($args);
        return vsprintf($string, $args);
    }
}
