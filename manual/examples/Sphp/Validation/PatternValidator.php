<?php

namespace Sphp\Core\Validators;


$validator = (new PatternValidator())
		->setPattern("/^\d+$/", "Please insert numbers only");

var_dump($validator->validate(" \n\r\t")->isValid()) . "\n";

$validator->allowEmptyValues(FALSE);
var_dump($validator->validate(" \n\r\t")->isValid()) . "\n";
echo $validator->getErrors() . "\n";
var_dump($validator->validate("a23")->isValid()) . "\n";
echo $validator->getErrors() . "\n";
var_dump($validator->validate("23")->isValid()) . "\n";
var_dump($validator->validate(0)->isValid()) . "\n";
?>