<?php

namespace Sphp\I18n\Messages;

use Sphp\I18n\Gettext\Translator;

$translator = new Translator();

$singular = new SingularTemplate("Please insert atleast %s of the following characters (%s)", $translator);
$plural = new PluralTemplate("%d file. Total size: At least %s", "%d files. Total size: At least %s", $translator);
$translator->setLang('fi_FI');
echo $singular->translate() . "\n";
echo $plural->translate() . "\n";
echo $plural->setPlural(true)->translate() . "\n";

$translator->setLang('en_US');


echo $singular->translate() . "\n";
echo $plural->setPlural(false)->translate() . "\n";
echo $plural->setPlural(true)->translate() . "\n";

