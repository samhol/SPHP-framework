<?php

namespace Sphp\I18n\Collections;

use Sphp\I18n\Messages\Message;

$translator = \Sphp\I18n\Translators::instance()->get('validation');

$c = new TranslatableCollection();

$c["group 1"] = (new TranslatableCollection())
        ->append(Message::singular("Please insert atleast %s of the following characters (%s)", [3, 'a, b, c, d, e, f']))
        ->append(Message::singular("Please insert a value"));
$c["group 2"] = (new TranslatableCollection())
        ->append(Message::singular("Please insert a correct email address"))
        ->append(Message::singular("Please insert alphabets and numbers only"))
        ->append(Message::plural("%s byte", "%s bytes", true, [300]));
$c["group 3"] = (new TranslatableCollection())
        ->append(Message::singular("foo%s", ["bar"]));
$translator->setLang("fi_FI");
print_r($c->setTranslator($translator)->toArray());

