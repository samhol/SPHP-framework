<?php

namespace Sphp\Validators;

//Locale::setMessageLocale("fi_FI.UTF-8");
//Translator::useTextDomain("Sphp.Validation");

$validator = new ValidatorChain();
$validator->appendValidator(new StringLengthValidator(2, 6), true);
$validator->appendValidator(new PatternValidator("/^[a-zA-Z]+$/", "Please insert alphabets only"));

echo "validating string '_illegal_':\n";
var_dump($validator->isValid('_illegal_')) . "\n";
print_r($validator->getErrors()->toArray()) . "\n";

echo "validating string 'lega3':\n";
var_dump($validator->isValid('lega3'));
print_r($validator->getErrors()->toArray()) . "\n";

echo "validating string 'legal':\n";
var_dump($validator('legal'));

