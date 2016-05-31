<?php

namespace Sphp\Validation;

use Sphp\Core\Gettext\Locale as Locale;

Locale::setMessageLocale("fi_FI.UTF-8");
//Translator::useTextDomain("Sphp.Validation");

$validator = (new PatternValidator())
		->setPattern("/^\d+$/", "Please insert numbers only");

//NULL value:
var_dump($validator->validate(" \n\r\t")->isValid()) . "\n";
//empty string:
$validator->allowEmptyValues(FALSE);
var_dump($validator->validate(" \n\r\t")->isValid()) . "\n";
echo $validator->getErrors() . "\n";
var_dump($validator->validate("a23")->isValid()) . "\n";
echo $validator->getErrors() . "\n";
var_dump($validator->validate("23")->isValid()) . "\n";
var_dump($validator->validate(0)->isValid()) . "\n";
?>