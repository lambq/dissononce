<?php

namespace Lambq\Dissononce\Processing\Impl;

use Lambq\Dissononce\Exception\NoiseProtocolException;
use Lambq\Dissononce\Processing\Handshakepatterns\Format;
use Lambq\Dissononce\Processing\Handshakepatterns\HandshakePattern;
use Lambq\Dissononce\Processing\SymmetricState;
use Lambq\Dissononce\Dh\PublicKey;
use Lambq\Dissononce\Dh\KeyPair;
use Lambq\Dissononce\Dh\Dh;

class HandshakeState
{
    protected $TEMPLATE_PROTOCOL_NAME = "Noise_{handshake}_{dh}_{cipher}_{hash}";
    protected SymmetricState $symmetricstate;
    protected $dh;
    protected $s;
    protected $e;
    protected $rs;
    protected $re;
    protected $initiator;
    protected $message_patterns;
    protected $protocol_name;
    protected $pskmode;

    public function __construct(SymmetricState $symmetricstate, Dh $dh)
    {
        $this->symmetricstate = $symmetricstate;  # type: SymmetricState
        $this->dh = $dh;  # type: DH
        $this->s = null;  # type: KeyPair
        $this->e = null;  # type: KeyPair | None
        $this->rs = null;  # type: PublicKey | None
        $this->re = null;  # type: PublicKey | None
        $this->initiator = null;
        $this->message_patterns = null;  # type: list[tuple[str]]
        $this->protocol_name = null;  # type: str | None
    }

    public function protocol_name()
    {
        return $this->protocol_name;
    }

    public function symmetricstate()
    {
        return $this->symmetricstate;
    }

    public function rs()
    {
        return $this->rs;
    }

    public function re()
    {
        return $this->re;
    }

    public function s()
    {
        return $this->s;
    }

    public function e()
    {
        return $this->e;
    }

    public function initialize(HandshakePattern $handshake_pattern, $initiator, $prologue, KeyPair $s=null, KeyPair $e=null, PublicKey $rs=null, PublicKey $re=null, $psks=null)
    {
        $this->protocol_name = $this->derive_protocol_name($handshake_pattern->name());
//        logger.info("Derived Noise Protocol name %s" % self._protocol_name)
//        logger.debug("\n%s", handshake_pattern)

        $this->symmetricstate->initialize_symmetric($this->protocol_name->encode());
//        logger.debug("MixHash(prologue)")
        $this->symmetricstate->mix_hash($prologue);
        $this->initiator = $initiator;
        $this->s    = $s;
        $this->e    = $e;
        $this->rs   = $rs;
        $this->re   = $re;
        $psks       = $psks !== null ? $psks : $psks;

        $this->psks = unpack('C*', $psks);

        if (is_array($handshake_pattern->name()))
        {
            if (in_array('psk', $handshake_pattern->name())) {
                $this->pskmode    = $handshake_pattern->name();
            }
        } else {
            if (strpos($handshake_pattern->name(), 'psk') !== false) {
                $this->pskmode    = $handshake_pattern->name();
            }
        }

        if (strlen($handshake_pattern->initiator_pre_message_pattern()) || strlen($handshake_pattern->responder_pre_message_pattern()))
        {
//            logger.info("Processing pre-messages")
            if ($initiator)
            {
                foreach ($handshake_pattern->initiator_pre_message_pattern() as $v)
                {
                    if ($v == 's')
                    {
//                        logger.debug("MixHash(s.public_key)")
                        $this->symmetricstate->mix_hash($s->public()->data());
                    }

                    if ($v == 'e')
                    {
//                        logger.debug("MixHash(e.public_key)")
                        $this->symmetricstate->mix_hash($e->public()->data());
                        if ($this->pskmode)
                        {
                            $this->symmetricstate->mix_key($e->public()->data());
                        }
                    }

                }
                foreach ($handshake_pattern->responder_pre_message_pattern() as $v)
                {
                    if ($v == 's')
                    {
//                        logger.debug("MixHash(rs)")
//                        assert rs is not None, "a pre_message required rs but was empty"
                        $this->symmetricstate->mix_hash($rs->data());
                    } elseif ($v == 'e') {
//                        logger.debug("MixHash(re)")
//                        assert re is not None, "a pre_message required re but was empty"
                        $this->symmetricstate->mix_hash($re->data());
                    }
                }
            } else {
                foreach ($handshake_pattern->initiator_pre_message_pattern() as $v)
                {
                    if ($v == 's')
                    {
//                        logger.debug("MixHash(rs)")
//                        assert rs is not None, "a pre_message required rs but was empty"
                        $this->symmetricstate->mix_hash($rs->data());
                    } elseif ($v == 'e') {
//                        logger.debug("MixHash(re)")
//                        assert re is not None, "a pre_message required re but was empty"
                        $this->symmetricstate->mix_hash($re->data());
                    }
                }
                foreach ($handshake_pattern->responder_pre_message_pattern() as $v)
                {
                    if ($v == 's')
                    {
//                        logger.debug("MixHash(rs)")
//                        assert rs is not None, "a pre_message required rs but was empty"
                        $this->symmetricstate->mix_hash($s->public()->data());
                    } elseif ($v == 'e') {
                        $this->symmetricstate->mix_hash($e->public()->data());
                        if ($this->pskmode)
                        {
                            $this->symmetricstate->mix_key($e->public()->data());
                        }
                    }
                }
            }
        }

        $this->message_patterns = unpack('C*', $handshake_pattern->message_patterns());
    }

    public function derive_protocol_name($handshake_pattern_name)
    {
        return Format::deriveProtocolName(
            $handshake_pattern_name,
            $this->dh->name(),
            $this->symmetricstate->ciphername(),
            $this->symmetricstate->hashname(),
            $this->TEMPLATE_PROTOCOL_NAME
        );
    }

    public function write_message($payload, $message_buffer)
    {
//        logger.info("WriteMessage(payload, message_buffer)")
        $message_pattern = array_pop($this->message_patterns);

        foreach ($message_pattern as $v)
        {
//            logger.debug("    Processing token '%s'" % token)
            if ($v == 'e')
            {
//                assert self._e is None, "e is not empty"

//                logger.debug("        e=GENERATE_KEYPAIR()")
                $this->e = $this->dh->generate_keypair();

//                logger.debug("        message_buffer.append(e.public_key)")
                $message_buffer->extend($this->e->public()->data());

//                logger.debug("        MixHash(e.public_key)")
                $this->symmetricstate->mix_hash($this->e->public()->data());
                if ($this->pskmode)
                {
//                    logger.debug("        MixKey(e.public_key)")
                    $this->symmetricstate->mix_key($this->e->public()->data());
                }
            } elseif ($v == 's') {
//                assert self._s is not None, "s is empty"
//                logger.debug("        buffer.append(EncryptAndHash(s.public_key))")
                $message_buffer->extend($this->symmetricstate->encrypt_and_hash($this->s->public()->data()));
            } elseif ($v == 'ee') {
//                logger.debug("        MixKey(DH(e, re))")
                $this->symmetricstate->mix_key($this->dh->dh($this->e, $this->re));
            } elseif ($v == 'es') {
                if ($this->initiator) {
//                    logger.debug("        MixKey(DH(e, rs))")
                    $this->symmetricstate->mix_key($this->dh->dh($this->e, $this->rs));
                } else {
//                    logger.debug("        MixKey(DH(s, re))")
                    $this->symmetricstate->mix_key($this->dh->dh($this->s, $this->re));
                }
            } elseif ($v == 'se') {
                if ($this->initiator) {
//                    logger.debug("        MixKey(DH(s, re))")
                    $this->symmetricstate->mix_key($this->dh->dh($this->s, $this->re));
                } else {
//                    logger.debug("        MixKey(DH(e, rs))")
                    $this->symmetricstate->mix_key($this->dh->dh($this->e, $this->rs));
                }
            } elseif ($v == 'ss') {
//                logger.debug("        MixKey(DH(s, rs))")
                $this->symmetricstate->mix_key($this->dh->dh($this->s, $this->rs));
            } elseif ($v == 'psk') {
//                assert self._psks is not None and len(self._psks), "psks is empty"
                $this->symmetricstate->mix_key_and_hash(array_pop($this->psks));
            } else {
                throw new NoiseProtocolException("Noise Processing Impl HandshakeState function write_message found in message_pattern token: {$v}");
            }
        }


//        logger.debug("    buffer.append(EncryptAndHash(payload))")
        $message_buffer->extend($this->symmetricstate->encrypt_and_hash($payload));
        if (strlen($this->message_patterns) == 0)
        {
            return $this->symmetricstate->split();
        }
    }

    public function read_message($message, $payload_buffer)
    {
//        logger.info("ReadMessage(message, payload_buffer)")
        $message_pattern = array_pop($this->message_patterns);

        foreach ($message_pattern as $v) {
//            logger.debug("    Processing token '%s'" % token)
            if ($v == 'e') {
//                assert self._re is None, "re is not empty"
//                logger.debug("        re=message[:DHLEN]")
                $this->re = $this->dh->create_public(substr($message, 0, $this->dh->dhlen()));
//                logger . debug("        MixHash(re.public_key)")
                $this->symmetricstate->mix_hash($this->re->data());
                $message = substr($message, $this->dh->dhlen());
                if ($this->pskmode)
                {
//                    logger . debug("        MixKey(re.public_key)")
                    $this->symmetricstate->mix_key($this->re->data());
                }

            } elseif ($v == 's') {
                if ($this->symmetricstate->cipherstate_has_key())
                {
//                    logger . debug("        temp=message[:DHLEN + 16]")
                    $temp = substr($message, 0, $this->dh->dhlen() + 16);
                } else {
//                    logger . debug("        temp=message[:DHLEN]")
                    $temp = substr($message, 0, $this->dh->dhlen());
                }


//                assert self . _rs is None, "rs is not empty"
//                logger . debug("        rs=DecryptAndHash(temp)")
                $this->rs   = $this->dh->create_public($this->symmetricstate->decrypt_and_hash($temp));
                $message    = substr($message, strlen($temp));
            } elseif ($v == 'ee') {
//                logger . debug("        MixKey(DH(e, re))")
                $this->symmetricstate->mix_key($this->dh->dh($this->e, $this->re));
            } elseif ($v == 'es') {
                if ($this->initiator)
                {
//                    logger . debug("        MixKey(DH(e, rs))")
                    $this->symmetricstate->mix_key($this->dh->dh($this->e, $this->rs));
                } else {
//                    logger . debug("        MixKey(DH(s, re))")
                    $this->symmetricstate->mix_key($this->dh->dh($this->s, $this->re));
                }
            } elseif ($v == 'se') {
                if ($this->initiator)
                {
//                    logger . debug("        MixKey(DH(s, re))")
                    $this->symmetricstate->mix_key($this->dh->dh($this->s, $this->re));
                } else {
//                    logger . debug("        MixKey(DH(e, rs))")
                    $this->symmetricstate->mix_key($this->dh->dh($this->e, $this->rs));
                }
            } elseif ($v == 'ss') {
//                logger . debug("        MixKey(DH(s, rs))")
                $this->symmetricstate->mix_key($this->dh->dh($this->s, $this->rs));
            } elseif ($v == 'psk') {
//                assert self . _psks is not None and len(self . _psks), "psks is empty"
                $this->symmetricstate->mix_key_and_hash(array_pop($this->psks));
            } else {
                throw new NoiseProtocolException('noise Processing HandshakeState function read_message token:' . $v);
            }
        }


//        logger.debug("    DecryptAndHash(message[remaining:])")
        $payload_buffer->extend($this->symmetricstate->decrypt_and_hash($message));

        if (strlen($this->message_patterns) == 0)
        {
            return $this->symmetricstate->split();
        }

    }
}

