<?php

namespace Sphp\Gettext;

Locale::setMessageLocale("fi_FI");
$messageCont1 = (new MessageList())
		->insertMessage("Message priority value %s", ["three"], 3)
		->insert(new Message("Message priority value %s", ["seven"]), 7)
		->insert(new Message("Message priority value %s", ["one"]), 1);
echo $messageCont1;
$messageCont1->setTranslator(new Translator("foo"));
echo $messageCont1;

$messageCont2 = (new MessageList())
		->merge($messageCont1)
		->insertMessage("Message priority value %s", ["nine"], 9);
echo $messageCont2;
?>