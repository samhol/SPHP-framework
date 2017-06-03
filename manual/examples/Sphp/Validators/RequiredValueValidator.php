<?php

namespace Sphp\Validators;

$validator = new NotEmptyValidator();
//NULL value:
var_dump($validator->isValid(null)) . "\n";
echo $validator->getErrors() . "\n";
//empty string:
var_dump($validator(" \n\r\t")) . "\n";
echo $validator->getErrors() . "\n";
//nonempty string:
var_dump($validator("string")) . "\n";
