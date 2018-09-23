<?php

namespace Sphp\Html\Lists;

$dl = new Dl();
$dl->appendTerm("Numbers:");
foreach (["zero", "one", "two", "three", "four"] as $number) {
  $dl->appendDescription($number);
}
$dl->printHtml();
