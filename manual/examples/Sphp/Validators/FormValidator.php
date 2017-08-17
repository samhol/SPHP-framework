<?php

namespace Sphp\Validators;

$validator = (new FormValidator())
        ->set('num', new PatternValidator("/^\d+$/", 'Please insert numbers only'))
        ->set('p1', new PatternValidator("/^[a-zA-Z]+$/", 'Please insert alphabets only'))
        ->set('p2', new PatternValidator("/^([a-zA-Z]){3}+$/", 'Please insert exactly 3 alphabets'));

$correctData = [
    'num' => '123',
    'p1' => 'abcde',
    'p2' => 'xyz'];

echo "Correct data:";
var_dump($validator->isValid($correctData));

$incorrectData = [
    'num' => 'abc',
    'p1' => '_err_',
    'p1' => '_err_'];

echo "\nincorrect data:";
var_dump($validator->isValid($incorrectData));
foreach ($validator->getInputErrors() as $fieldName => $error) {
  echo "\n$fieldName: $error";
}
