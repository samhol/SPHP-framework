<?php

namespace Sphp\Validators;

$validator = (new StringLengthValidator());
echo "Lower bound validation:\n";
$validator->setLowerBoundValidation(4);
var_dump($validator->isValid('лдэ')) . "\n";
print_r($validator->errorsToArray()) . "\n";

echo "Upper bound validation:\n";
$validator->setUpperBoundValidation(5);
var_dump($validator->isValid('лдэф')) . "\n";

echo "Range validation:\n";
$validator->setRangeValidation(10, 15);
var_dump($validator->isValid("string")) . "\n";
print_r($validator->errorsToArray()) . "\n";
