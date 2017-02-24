<?php

namespace Sphp\Validators;

//Locale::setMessageLocale("fi_FI.UTF-8");
//Translator::useTextDomain("Sphp.Validation");

$validator = new ValidatorAggregate();
$validator->appendValidator(new StringLengthValidator(2, 6), true);
$validator->appendValidator(new PatternValidator("/^[a-zA-Z]+$/", "Please insert alphabets only"));

echo "validating string '_illegal_':\n";
var_dump($validator->isValid('_illegal_')) . "\n";
echo $validator->getErrors() . "\n";

echo "validating string 'lega3':\n";
var_dump($validator->isValid('lega3'));

echo "validating string 'legal':\n";
var_dump($validator('legal'));

?>