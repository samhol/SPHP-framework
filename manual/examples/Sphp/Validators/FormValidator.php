<?php

namespace Sphp\Validators;

$validator = (new FormValidator())
        ->set("not_empty", new NotEmpty())
        ->set("url", new UrlValidator())
        ->set("num", new Regex("/^\d+$/", "Please insert numbers only"))
        ->set("p1", new Regex("/^[a-zA-Z]+$/", "Please insert alphabets only"))
        ->set("p2", new Regex("/^([a-zA-Z]){3}+$/", "Please insert exactly 3 alphabets"));

$correctData = [
    "not_empty" => "foo",
    "url" => 'https://www.google.com/',
    'num' => '123',
    'p1' => 'abcde',
    "p2" => 'xyz'];

echo "Correct data:";
var_dump($validator->isValid($correctData));
print_r($validator->getInputErrors());

$incorrectData = [
    'num' => 'abc',
    "url" => 'http://foo',
    'p1' => '_err_',
    'p2' => '_err_'];

echo "\nincorrect data:";
var_dump($validator->isValid($incorrectData));
print_r($validator->getInputErrors());
