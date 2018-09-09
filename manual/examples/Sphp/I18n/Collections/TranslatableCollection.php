<?php

namespace Sphp\I18n\Collections;

use Sphp\I18n\Translators;
use Sphp\I18n\Messages\Msg;

$translator = Translators::instance()->getDefault();
$msg = Msg::singular("%s:%s:%s elapsed", [3, 24, '03'], $translator);
$messageCont1 = (new TranslatableCollection())
        ->append(Msg::singular("%s:%s:%s left", [12, 10, '01'], $translator))
        ->append(Msg::singular("Please insert atleast %s of the following characters (%s)", [2, "a, b, c"], $translator))
        ->append($msg);

$translator->setLang('fi_FI');
print_r($messageCont1->translateWith($translator));

foreach ($messageCont1 as $m) {
  echo "\n$m";
}
