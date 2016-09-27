<?php

namespace Sphp\Core\Validators;

use Sphp\Core\Configuration;
use Sphp\Core\Gettext\Locale;
use Sphp\Core\Gettext\Translator;
Configuration::useDomain("manual")->phpConfiguration()->setMessageLocale("fi_FI.UTF-8");
var_dump(Configuration::useDomain("manual")->phpConfiguration()->getMessageLocale());
//var_dump(Translator::useTextDomain("default"));
var_dump(Locale::getMessageLocale());
//var_dump(Translator::getCurrentTextDomain());

$validator = new RequiredValueValidator();
//NULL value:
var_dump($validator->validate(NULL)->isValid()) . "\n";
echo $validator->getErrors() . "\n";
//empty string:
var_dump($validator->validate(" \n\r\t")->isValid()) . "\n";
echo $validator->getErrors() . "\n";
//nonempty string:
var_dump($validator->validate("string")->isValid()) . "\n";
?>
