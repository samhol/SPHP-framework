<?php

use Sphp\Config\ShutDownRegister1;

echo '<pre>';
$s = new ShutDownRegister1();
var_dump($s->addCallable(function () {
          echo 'foo';
        }));
var_dump($s->addCallable(function () {
          echo '_is_';
        }));
var_dump($s->addCallable(function () {
          echo 'bar';
        }));
var_dump($s->addCallable(function () {
          echo '?';
        }));

$s();

use Sphp\Stdlib\Datastructures\ObjectStorage;

$objStorage = new ObjectStorage();

var_dump($objStorage->attach(function () {
          echo 'Foo';
        }));
var_dump($objStorage->attach(function () {
          echo ' is ';
        }));
var_dump($objStorage->attach(function () {
          echo 'Bar';
        }));
var_dump($objStorage->attach(function () {
          echo '?';
        }));


foreach ($objStorage as $id => $obj) {
  //echo "\nid: $id\n";
  $obj();
}
echo '</pre>';
