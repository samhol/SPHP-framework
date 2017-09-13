<?php

namespace Sphp\I18n\Messages;

use Sphp\I18n\Gettext\Translator;

$translator = new Translator();


$singular = Message::singular("Please insert atleast %s of the following characters (%s)", [2, "a, b, c"], $translator);
$plural = Message::plural("%s byte", "%s bytes", true, [300], $translator);

echo "singular: {$singular->translate()}\n";
echo "plural: {$plural->translate()}\n";

$translator->setLang('fi_FI');

$plural->setPlural(false)->setArguments([1]);

echo "singular: $singular\n";
echo "plural: $plural\n";

