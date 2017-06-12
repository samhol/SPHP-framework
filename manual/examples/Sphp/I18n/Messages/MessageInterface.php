<?php

namespace Sphp\I18n\Messages;

use Sphp\I18n\Gettext\Translator;

$translator = new Translator();
$msg = new Message(new SingularTemplate("Please insert atleast %s of the following characters (%s)", $translator), [2, "a, b, c"]);
echo "message in english: $msg\n";
$translator->setLang('fi_FI');
echo "message in finnish: {$msg->setArguments([4, 'a,b,c,d,e,f,g'])}\n";
$plural = Message::plural("%d file. Total size: At least %s", "%d files. Total size: At least %s", false, [1, '100kb']);
echo "$plural\n";
$plural->getTemplate()->setPlural(true);
$plural->setArguments([4, '100kb']);
echo "$plural\n";
