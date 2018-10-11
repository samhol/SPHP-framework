<?php

use Sphp\Stdlib\Parsers\Parser;
use Sphp\Stdlib\Arrays;

function rest(array $arr) {
  $type = key($arr);
  $data = $arr[$type];
  $output = '';
  if (is_scalar($data)) {
    $output .= '["' . $type . '" => "' . $data . '"];';
  } else {
    $output .= '["' . $type . '" => ["' . Arrays::implodeWithKeys($data, '", "', '" => "') . '"]];';
  }
  return $output;
}

foreach (Parser::yaml()->readFromFile('manual/examples/Sphp/Html/Head/meta.yaml') as $v) {
  echo '$head[] = ' . rest($v) . "\n";
}
