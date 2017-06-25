<?php

namespace Sphp\Validators;

$validator = (new PatternValidator("Please insert numbers only"))
        ->setPattern("/^\d+$/");

var_dump($validator->isValid(" \n\r\t")) . "\n";

var_dump($validator->isValid(" \n\r\t")) . "\n";
echo $validator->getErrors() . "\n";
var_dump($validator->isValid("a23")) . "\n";
echo $validator->getErrors() . "\n";
var_dump($validator->isValid("23")) . "\n";
var_dump($validator->isValid(0)) . "\n";
