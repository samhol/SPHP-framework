<?php

namespace Sphp\Validators;

$validator = new NotEmptyValidator();
//NULL value:
var_dump($validator->isValid(null)) . "\n";
print_r($validator->getErrors()->toArray()) . "\n";
//empty string:
var_dump($validator(" \n\r\t")) . "\n";
print_r($validator->getErrors()->toArray()) . "\n";
//nonempty string:
var_dump($validator("string")) . "\n";
