<?php

namespace Sphp\I18n\Collections;

use Sphp\I18n\Messages\Msg;

$translator = \Sphp\I18n\Translators::instance()->get('validation');

$c = new TranslatableCollection();

$c["group 1"] = (new TranslatableCollection())
        ->append(Msg::singular("Please insert atleast %s of the following characters (%s)", [3, 'a, b, c, d, e, f']))
        ->append(Msg::singular("Please insert a value"));
$c["group 2"] = (new TranslatableCollection())
        ->append(Msg::singular("Please insert a correct email address"))
        ->append(Msg::singular("Please insert alphabets and numbers only"))
        ->append(Msg::plural("%s byte", "%s bytes", true, [300]));
$c["group 3"] = (new TranslatableCollection())
        ->append(Msg::singular("foo%s", ["bar"]));
$translator->setLang("fi_FI");
print_r($c->setTranslator($translator)->toArray());

