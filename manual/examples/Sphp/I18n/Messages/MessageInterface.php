<?php

namespace Sphp\I18n\Messages;

use Sphp\I18n\Gettext\Translator;

$translator = new Translator();
\Sphp\I18n\Translators::instance()->setDefault($translator);
$msg = new Message(new SingularTemplate("%s:%s:%s elapsed", $translator), [3, 24, '03']);
echo "message in english: $msg\n";
$translator->setLang('fi_FI');
echo "message in finnish: $msg\n";
$plural = Message::plural("%d file. Total size: At least %s", "%d files. Total size: At least %s", false, [1, '100kb']);
echo "$plural\n";
$plural->getTemplate()->setPlural(true);
$plural->setArguments([4, '100kb']);
echo "$plural\n";
