<?php

namespace Sphp\Core\Types;

$str1 = new StringObject("abcdefghijklmnopqrstyvwxyzåäö");
$s = function (StringObject $str) {
  print "'$str':\n";
  print " length: " . $str->count() . "\n";
  print " length is between 0-10: " . ($str->lengthBetween(0, 10) ? "yes" : "no") . "\n";
  print ($str->notEmpty() ? " is not empty" : " is empty") . "\n";
  print " contains 'efg': " . ($str->contains("efg") ? "yes" : "no") . "\n";
  print " contains 'gfe': " . ($str->contains("gfe") ? "yes" : "no") . "\n";
  print " character at index 10: '{$str->charAt(10)}'\n";
  print " last character: '{$str->charAt($str->count() - 1)}'\n";
};

$s($str1);
$str2 = new StringObject("üöäå", "UTF-8");

$s($str2);
?>
