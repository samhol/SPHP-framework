<?php

namespace Sphp\Stdlib;

$str1 = new StringObject("abcdefghijklmnopqrstyvwxyzåäö");
$s = function (StringObject $str) {
  print "'$str':\n";
  print "\tlength: " . $str->count() . "\n";
  print "\tlength is between 0-10: " . ($str->lengthBetween(0, 10) ? "yes" : "no") . "\n";
  print ($str->isEmpty() ? "\tis not empty" : "\tis empty") . "\n";
  print "\tcontains 'efg': " . ($str->contains("efg") ? "yes" : "no") . "\n";
  print "\tcontains 'gfe': " . ($str->contains("gfe") ? "yes" : "no") . "\n";
  print "\tcharacter at index 10: '{$str->charAt(10)}'\n";
  print "\tlast character: '{$str->charAt($str->count() - 1)}'\n";
};

$s($str1);
$str2 = new StringObject("üöäå", "UTF-8");

$s($str2);
