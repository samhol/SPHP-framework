<?php

namespace Sphp\I18n\Collections;

use Sphp\I18n\Messages\Msg;

$list = new TranslatablePriorityList();

$translator = \Sphp\I18n\Translators::instance()->getDefault()->setLang("fi_FI");

$list->insert(Msg::singular("%s is not valid", ["path"], $translator)->translateArguments(), 1);
$list->insert(Msg::singular("%s is not valid", ["password"], $translator)->translateArguments(), 10);
$list->insert(Msg::singular("%s is not valid", ["host"], $translator)->translateArguments(), 5);


foreach ($list as $value) {
  echo $value->getFormattedTemplate() . ":\t$value\n";
}
echo "------------------\n";
$list->insert(Msg::singular("%s is not valid", ["Foobar"], $translator)->translateArguments(), 5);

foreach ($list as $value) {
  echo $value->getFormattedTemplate() . ":\t$value\n";
}
