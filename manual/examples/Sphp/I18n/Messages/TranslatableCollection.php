<?php

namespace Sphp\I18n\Messages;

use Sphp\I18n\Gettext\Translator;

$translator = new Translator();
$msg = new Message(new SingularTemplate("%s:%s:%s elapsed", $translator), [3, 24, '03']);
$messageCont1 = (new TranslatableList())
        ->insert(new SingularTemplate("%s:%s:%s left"))
        ->insert($msg);
echo $messageCont1;
$messageCont1->setLang('en_US');
echo $messageCont1;

