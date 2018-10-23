<?php

namespace Sphp\Validators;

$validator = new NotEmptyValidator();
//NULL value:
var_dump($validator->isValid(null)) . "\n";
print_r($validator->errorsToArray()) . "\n";
//empty string:
var_dump($validator(" \n\r\t")) . "\n";
print_r($validator->errorsToArray()) . "\n";
//nonempty string:
var_dump($validator("string")) . "\n";
