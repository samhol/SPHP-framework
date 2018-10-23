<?php

namespace Sphp\Validators;

$validator = (new Regex("/^\d+$/", "Please insert numbers only"));

var_dump($validator->isValid(" \n\r\t")) . "\n";

var_dump($validator->isValid(" \n\r\t")) . "\n";
print_r($validator->errorsToArray()) . "\n";
var_dump($validator->isValid("a23")) . "\n";
print_r($validator->errorsToArray()) . "\n";
var_dump($validator->isValid("23")) . "\n";
var_dump($validator->isValid(0)) . "\n";
