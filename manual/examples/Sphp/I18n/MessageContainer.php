<?php

namespace Sphp\I18n;

$messageCont1 = (new PrioritizedMessageList())->setLang('fi_FI')
		->insertMessage("Message priority value %s", ["three"], 3)
		->insert(new Message("Message priority value %s", ["seven"]), 7)
		->insert(new Message("Message priority value %s", ["one"]), 1);
echo $messageCont1;
$messageCont1->setLang('en_US');
echo $messageCont1;

$messageCont2 = (new PrioritizedMessageList())
		->merge($messageCont1)
		->insertMessage("Message priority value %s", ["nine"], 9);
echo $messageCont2;
