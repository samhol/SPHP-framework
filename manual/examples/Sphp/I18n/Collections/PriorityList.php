<?php

namespace Sphp\I18n\Collections;

use Sphp\I18n\Messages\Message;

$list = new TranslatablePriorityList();
$translator = \Sphp\I18n\Translators::instance()->getDefault();
$translator->setLang("fi_FI");
$list->insert(Message::singular("%s is not valid", ["path"], $translator)->translateArguments(), 1);
$list->insert(Message::singular("%s is not valid", ["password"], $translator)->translateArguments(), 10);
$list->insert(Message::singular("%s is not valid", ["host"], $translator)->translateArguments(), 5);


foreach ($list as $value) {
  echo $value->getTemplate() . ": $value\n";
}
