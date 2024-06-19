<?php

namespace Lambq\Dissononce\Extras\Meta\Pattern;


use Lambq\Dissononce\Processing\Handshakepatterns\Oneway\NHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\NNHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\NKHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\NXHandshakePattern;

use Lambq\Dissononce\Processing\Handshakepatterns\Oneway\KHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\KNHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\KKHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\KXHandshakePattern;

use Lambq\Dissononce\Processing\Handshakepatterns\Oneway\XHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\XNHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\XKHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\XXHandshakePattern;

use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\INHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\IKHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Interactive\IXHandshakePattern;

use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\NK1HandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\NX1HandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\X1NHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\X1KHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\XK1HandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\X1K1HandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\X1XHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\XX1HandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\X1X1HandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\K1NHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\K1KHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\KK1HandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\K1K1HandshakePattern;

use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\K1XHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\KX1HandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\K1X1HandshakePattern;

use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\I1NHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\I1KHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\IK1HandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\I1K1HandshakePattern;

use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\I1XHandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\IX1HandshakePattern;
use Lambq\Dissononce\Processing\Handshakepatterns\Deferred\I1X1HandshakePattern;

class Pattern
{
    protected $NAME_PATTERN_N = 'N';
    protected $NAME_PATTERN_K = 'K';
    protected $NAME_PATTERN_X = 'X';
    protected $NAME_PATTERN_NN = 'NN';
    protected $NAME_PATTERN_NK = 'NK';
    protected $NAME_PATTERN_NX = 'NX';
    protected $NAME_PATTERN_XN = 'XN';
    protected $NAME_PATTERN_XK = 'XK';
    protected $NAME_PATTERN_XX = 'XX';
    protected $NAME_PATTERN_KN = 'KN';
    protected $NAME_PATTERN_KK = 'KK';
    protected $NAME_PATTERN_KX = 'KX';
    protected $NAME_PATTERN_IN = 'IN';
    protected $NAME_PATTERN_IK = 'IK';
    protected $NAME_PATTERN_IX = 'IX';
    protected $NAME_PATTERN_NK1 = 'NK1';
    protected $NAME_PATTERN_NX1 = 'NX1';
    protected $NAME_PATTERN_X1N = 'X1N';
    protected $NAME_PATTERN_X1K = 'X1K';
    protected $NAME_PATTERN_XK1 = 'XK1';
    protected $NAME_PATTERN_X1K1 = 'X1K1';
    protected $NAME_PATTERN_X1X = 'X1X';
    protected $NAME_PATTERN_XX1 = 'XX1';
    protected $NAME_PATTERN_X1X1 = 'X1X1';
    protected $NAME_PATTERN_K1N = 'K1N';
    protected $NAME_PATTERN_K1K = 'K1K';
    protected $NAME_PATTERN_KK1 = 'KK1';
    protected $NAME_PATTERN_K1K1 = 'K1K1';
    protected $NAME_PATTERN_K1X = 'K1X';
    protected $NAME_PATTERN_KX1 = 'KX1';
    protected $NAME_PATTERN_K1X1 = 'K1X1';
    protected $NAME_PATTERN_I1N = 'I1N';
    protected $NAME_PATTERN_I1K = 'I1K';
    protected $NAME_PATTERN_IK1 = 'IK1';
    protected $NAME_PATTERN_I1K1 = 'I1K1';
    protected $NAME_PATTERN_I1X = 'I1X';
    protected $NAME_PATTERN_IX1 = 'IX1';
    protected $NAME_PATTERN_I1X1 = 'I1X1';
    protected $MAP_PATTERN;
    public function __construct()
    {
        $this->MAP_PATTERN = [
            'NAME_PATTERN_NN'   => new NNHandshakePattern(), 'NAME_PATTERN_NK'  => new NKHandshakePattern(), 'NAME_PATTERN_NX'  => new NXHandshakePattern(),
            'NAME_PATTERN_XN'   => new XNHandshakePattern(), 'NAME_PATTERN_XK'  => new XKHandshakePattern(), 'NAME_PATTERN_XX'  => new XXHandshakePattern(),
            'NAME_PATTERN_KN'   => new KNHandshakePattern(), 'NAME_PATTERN_KK'  => new KKHandshakePattern(), 'NAME_PATTERN_KX'  => new KXHandshakePattern(),
            'NAME_PATTERN_IN'   => new INHandshakePattern(), 'NAME_PATTERN_IK'  => new IKHandshakePattern(), 'NAME_PATTERN_IX'  => new IXHandshakePattern(),
            'NAME_PATTERN_N'    => new NHandshakePattern(), 'NAME_PATTERN_K'    => new KHandshakePattern(), 'NAME_PATTERN_X'    => new XHandshakePattern(),
            'NAME_PATTERN_NK1'  => new NK1HandshakePattern(), 'NAME_PATTERN_NX1'    => new NX1HandshakePattern(),
            'NAME_PATTERN_X1N'  => new X1NHandshakePattern(), 'NAME_PATTERN_X1K'    => new X1KHandshakePattern(),
            'NAME_PATTERN_XK1'  => new XK1HandshakePattern(),
            'NAME_PATTERN_X1K1' => new X1K1HandshakePattern(), 'NAME_PATTERN_X1X'   => new X1XHandshakePattern(),
            'NAME_PATTERN_XX1'  => new XX1HandshakePattern(), 'NAME_PATTERN_X1X1'   => new X1X1HandshakePattern(),
            'NAME_PATTERN_K1N'  => new K1NHandshakePattern(), 'NAME_PATTERN_K1K'    => new K1KHandshakePattern(),   'NAME_PATTERN_KK1' => new KK1HandshakePattern(),
            'NAME_PATTERN_K1K1' => new K1K1HandshakePattern(), 'NAME_PATTERN_K1X'   => new K1XHandshakePattern(),
            'NAME_PATTERN_KX1'  => new KX1HandshakePattern(), 'NAME_PATTERN_K1X1'   => new K1X1HandshakePattern(),
            'NAME_PATTERN_I1N'  => new I1NHandshakePattern(), 'NAME_PATTERN_I1K'    => new I1KHandshakePattern(), 'NAME_PATTERN_IK1'    => new IK1HandshakePattern(),
            'NAME_PATTERN_I1K1' => new I1K1HandshakePattern(), 'NAME_PATTERN_I1X'   => new I1XHandshakePattern(),
            'NAME_PATTERN_IX1'  => new IX1HandshakePattern(), 'NAME_PATTERN_I1X1'   => new I1X1HandshakePattern(),
        ];
    }

    public function getMapPATTERN()
    {
        return $this->MAP_PATTERN;
    }
}
