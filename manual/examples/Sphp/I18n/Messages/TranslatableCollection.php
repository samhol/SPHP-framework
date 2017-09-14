<?php

namespace Sphp\I18n\Messages;

use Sphp\I18n\Gettext\Translator;

$translator = new Translator();
$msg = Message::singular("%s:%s:%s elapsed", [3, 24, '03'], $translator);
$messageCont1 = (new TranslatableCollection())
        ->insert(Message::singular("%s:%s:%s left", [12, 10, '01'], $translator))
        ->insert(Message::singular("Please insert atleast %s of the following characters (%s)", [2, "a, b, c"], $translator))
        ->insert($msg);
$messageCont1;
$translator->setLang('fi_FI');
print_r($messageCont1->translateWith($translator));

foreach ($messageCont1 as $m) {
  echo "\n$m";
}
