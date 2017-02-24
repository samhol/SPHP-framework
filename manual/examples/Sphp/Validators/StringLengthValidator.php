<?php

namespace Sphp\Validators;

$validator = (new StringLengthValidator())
		->allowEmptyValues(FALSE);
echo "Lower bound validation:\n";
$validator->setLowerBoundValidation(4)
		->validate('лдэ');
var_dump($validator->isValid()) . "\n";
echo $validator->getErrors() . "\n";

echo "Upper bound validation:\n";
$validator->setUpperBoundValidation(5)
		->validate('лдэф');
var_dump($validator->isValid()) . "\n";
echo $validator->getErrors() . "\n";
echo "Range validation:\n";
$validator->setRangeValidation(10, 15)
		->validate("string");
var_dump($validator->isValid()) . "\n";
echo $validator->getErrors() . "\n";
?>