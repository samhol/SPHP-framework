<?php

include_once(__DIR__."/../../manualTools/main.php");

return function(Sphp\Objects\ArrayableObjectInterface $obj) use ($api) {
  $output = "\n" . $api->classLinker($obj) . "\n";
  foreach ($obj->toArray() as $prop => $value) {
    $output .= " :$prop: $value\n";
  }
  return $output;
};
