<?php

namespace Sphp\Stdlib;

$str1 = new MbString("abcdefghijklmnopqrstyvwxyzåäö");
$s = function (MbString $str) { 
  print "'$str':\n";
  print "\tlength: " . $str->count() . "\n";
  print ($str->isEmpty() ? "\tis not empty" : "\tis empty") . "\n";
  print "\tcontains 'efg': " . ($str->contains("efg") ? "yes" : "no") . "\n";
  print "\tcontains 'gfe': " . ($str->contains("gfe") ? "yes" : "no") . "\n";
  print "\tcharacter at index 2: '{$str->charAt(2)}'\n";
  print "\tlast character: '{$str->charAt($str->count() - 1)}'\n";
};

$s($str1);
$str2 = new MbString("üöäå", "UTF-8");

$s($str2);
