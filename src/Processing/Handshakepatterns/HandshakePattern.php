<?php

namespace Lambq\Dissononce\Processing\Handshakepatterns;

use Lambq\Dissononce\Exception\NoiseProtocolException;

class HandshakePattern
{
    protected $REGEX_PATTERN_NAME_MODIFIERS = '^([A-Z1-9]{1,4})([a-z0-9+]+)*$';
    protected $TEMPLATE_REPR    = "{name}:\n{patterns}";
    protected $TEMPLATE_REPR_PATTERNS_WITH_PRE  = "{s}\n  ...\n{a}";
    protected $TEMPLATE_REPR_MESSAGE_SEND   = "  -> {s}";
    protected $TEMPLATE_REPR_MESSAGE_RECV   = "  <- {s}";

    protected $name;
    protected $origin_pattern;
    protected $modifiers;

    protected $message_patterns;
    protected $initiator_pre_message_pattern;
    protected $responder_pre_message_pattern;
    protected $interpret_as_bob;

    public function __construct($name, $message_patterns, $initiator_pre_messages = null, $responder_pre_message_pattern = null, $interpret_as_bob = false)
    {
        $this->name                             = $name;  # type: str
        [$origin_pattern, $modifiers]           = $this->parse_handshakepattern($this->name);
        $this->origin_pattern                   = $origin_pattern;
        $this->modifiers                        = $modifiers;
        $this->message_patterns                 = $message_patterns;  # type: tuple[tuple[str]]
        $this->initiator_pre_message_pattern    = $initiator_pre_messages or new TupleDictionary();  # type: tuple[str]
        $this->responder_pre_message_pattern    = $responder_pre_message_pattern or new TupleDictionary();  # type: tuple[str]
        $this->interpret_as_bob                 = $interpret_as_bob;  # type: bool
    }

    public function __toString() {
        $out_pre = [];
        $out_messages = [];
        $templ_send = $this->TEMPLATE_REPR_MESSAGE_SEND;
        $templ_recv = $this->TEMPLATE_REPR_MESSAGE_RECV;

        foreach ($this->initiator_pre_message_pattern as $v)
        {
            $out_pre[]  = Format::getAppend($v, $templ_send);
        }

        foreach ($this->responder_pre_message_pattern as $v)
        {
            $out_pre[]  = Format::getAppend($v, $templ_recv);
        }

        for($i=0;$i<count($this->message_patterns);$i++)
        {
            $use_send = $i % 2 == 0;
            if ($this->interpret_as_bob)
            {
                $use_send = !$use_send; // 反转变量的布尔值
            }
            $template       = $use_send ? $templ_send : $templ_recv;
            $out_messages[] = Format::getAppend($this->message_patterns[$i] , $template);
        }


        $message_patterns_formatted = "\n".join($out_messages);
        if (strlen($out_pre))
        {
            $pre_formatted = "\n".join($out_pre);
            $patterns_formatted = Format::getTemplate($pre_formatted, $message_patterns_formatted, $this->TEMPLATE_REPR_PATTERNS_WITH_PRE);
        } else {
            $patterns_formatted = $message_patterns_formatted;
        }

        return Format::getTemplate($this->name, $patterns_formatted, $this->TEMPLATE_REPR);
    }

    public function name()
    {
        $this->name;
    }

    public function interpret_as_bob()
    {
        $this->interpret_as_bob;
    }

    public function message_patterns()
    {
        $this->message_patterns;
    }

    public function initiator_pre_message_pattern()
    {
        $this->initiator_pre_message_pattern;
    }

    public function responder_pre_message_pattern()
    {
        $this->responder_pre_message_pattern;
    }

    public function origin_name()
    {
        $this->origin_pattern;
    }

    public function modifiers()
    {
        $this->modifiers;
    }

    public function parse_handshakepattern($handshake_pattern_name)
    {
        preg_match($this->REGEX_PATTERN_NAME_MODIFIERS, $handshake_pattern_name,$matches);
        $matches = $this->allData($matches);
        if (strlen($matches) == 2) {
            return [
                'origin_pattern'    => $matches[0],
                'modifiers'         => new TupleDictionary(explode('+', $matches[1]))
            ];
        } elseif (strlen($matches) == 1) {
            return [
                'origin_pattern'    => $matches[0],
                'modifiers'         => '()',
            ];
        } else {
            throw new NoiseProtocolException('noise Processing Handshakepatterns parse_handshakepattern pattern format: ' . $handshake_pattern_name);
        }
    }

    function allData($matches)
    {
        $arr    = [];
        $data   = $this->filter_non_null($matches);
        foreach ($data as $v)
        {
            $arr[]  = $v;
        }
        return $arr;
    }
    function filter_non_null($matches) {
        foreach ($matches as $match) {
            if ($match !== null) {
                yield $match;
            }
        }
    }
}

//REGEX_PATTERN_NAME_MODIFIERS = r"([A-Z1-9]{1,4})([a-z0-9+]+)*"
//
//    TEMPLATE_REPR = "{name}:\n{patterns}"
//    TEMPLATE_REPR_PATTERNS_WITH_PRE = "{pre_patterns}\n  ...\n{message_patterns}"
//    TEMPLATE_REPR_MESSAGE_SEND = "  -> {tokens}"
//    TEMPLATE_REPR_MESSAGE_RECV = "  <- {tokens}"
//
//    def __init__(self,
//    name,
//    message_patterns,
//    initiator_pre_messages=None,
//    responder_pre_message_pattern=None,
//    interpret_as_bob=False
//):
//        """
//        :param name:
//        :type name: str
//        :param message_pattern:
//        :type message_pattern: tuple[tuple[str]]
//        :param initiator_pre_messages:
//        :type initiator_pre_messages: tuple[str]
//        :param responder_pre_message_pattern:
//        :type responder_pre_message_pattern: tuple[str]
//        """
//        self._name = name  # type: str
//        self._origin_pattern, self._modifiers = self.__class__.parse_handshakepattern(self._name)
//        self._message_patterns = message_patterns  # type: tuple[tuple[str]]
//        self._initiator_pre_message_pattern = initiator_pre_messages or tuple()  # type: tuple[str]
//        self._responder_pre_message_pattern = responder_pre_message_pattern or tuple()  # type: tuple[str]
//        self._interpret_as_bob = interpret_as_bob  # type: bool
//
//    def __str__(self):
//        out_pre = []
//        out_messages = []
//        templ_send = self.__class__.TEMPLATE_REPR_MESSAGE_SEND
//        templ_recv = self.__class__.TEMPLATE_REPR_MESSAGE_RECV
//
//        for pattern in self._initiator_pre_message_pattern:
//            out_pre.append(templ_send.format(tokens=", ".join(pattern)))
//
//        for pattern in self.responder_pre_message_pattern:
//            out_pre.append(templ_recv.format(tokens=", ".join(pattern)))
//
//        for i in range(0, len(self.message_patterns)):
//            use_send = i % 2 == 0
//            if self.interpret_as_bob:
//                use_send = not use_send
//            template = templ_send if use_send else templ_recv
//            out_messages.append(template.format(tokens=", ".join(self.message_patterns[i])))
//
//        message_patterns_formatted = "\n".join(out_messages)
//        if len(out_pre):
//            pre_formatted = "\n".join(out_pre)
//            patterns_formatted = self.__class__.TEMPLATE_REPR_PATTERNS_WITH_PRE.format(
//                    pre_patterns=pre_formatted,
//                    message_patterns=message_patterns_formatted
//                )
//        else:
//            patterns_formatted = message_patterns_formatted
//
//        return self.__class__.TEMPLATE_REPR.format(name=self.name, patterns=patterns_formatted)
//
//    @property
//    def name(self):
//        return self._name
//
//    @property
//    def interpret_as_bob(self):
//        return self._interpret_as_bob
//
//    @property
//    def message_patterns(self):
//        return self._message_patterns
//
//    @property
//    def initiator_pre_message_pattern(self):
//        return self._initiator_pre_message_pattern
//
//    @property
//    def responder_pre_message_pattern(self):
//        return self._responder_pre_message_pattern
//
//    @property
//    def origin_name(self):
//        return self._origin_pattern
//
//    @property
//    def modifiers(self):
//        return self._modifiers
//
//    @classmethod
//    def parse_handshakepattern(cls, handshake_pattern_name):
//        matches = re.search(cls.REGEX_PATTERN_NAME_MODIFIERS, handshake_pattern_name).groups()[:]
//        matches = [match for match in matches if match is not None]
//        if len(matches) == 2:
//            return matches[0], tuple(matches[1].split('+'))
//        elif len(matches) == 1:
//            return matches[0], ()
//        else:
//            raise ValueError("Unknown handshake pattern format: %s" % handshake_pattern_name)
