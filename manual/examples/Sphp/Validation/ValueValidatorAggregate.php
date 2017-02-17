<?php

namespace Sphp\Core\Validators;

use Sphp\Core\Gettext\Locale as Locale;

//Locale::setMessageLocale("fi_FI.UTF-8");
//Translator::useTextDomain("Sphp.Validation");

$validator = new ValidatorAggregate();
$validator["length"] = new StringLengthValidator(2, 5);
$validator["pattern"] = new PatternValidator("/^[a-zA-Z]+$/", "Please insert alphabets only");

echo "validating string '_illegal_':\n";
$validator->validate("_illegal_");
var_dump($validator->isValid()) . "\n";
echo $validator->getErrors() . "\n";

echo "validating string 'legal':\n";
$validator->validate("legal");
var_dump($validator->isValid());

?>