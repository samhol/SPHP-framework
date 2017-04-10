<?php

namespace Sphp\Validators;

$validator = (new FormValidator())
        ->set('numbers', new PatternValidator("/^\d+$/", 'Please insert numbers only'))
        ->set('alphabets', (new PatternValidator("/^[a-zA-Z]+$/", 'Please insert alphabets only')))
        ->set('10alphabets', new PatternValidator("/^([a-zA-Z]){10}+$/", 'Please insert exactly 10 alphabets'));

$data1 = [
    'numbers' => '123',
    'alphabets' => 'abc',
    '10alphabets' => 'abcdefghij',
    'password' => '3a=_23aaA@'];

echo "validating data1:";
var_dump($validator->isValid($data1));

$data2 = [
    'numbers' => 'abc',
    '10alphabets' => '012345678910',
    'password' => '.'];

echo "validating data2:";
var_dump($validator->isValid($data2));
echo $validator->getInputErrors();
?>