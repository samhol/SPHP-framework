<?php

use Sphp\Stdlib\Parsers\Parser;

$faData = Parser::fromFile('manual/snippets/icons/icons.yml');
  foreach ($faData as $key => $val) {
    if (in_array('solid', $val['styles'])) {
      echo'<div><i class="fas fa-' . $key . ' fa-lg fa-fw"></i></div> ';
    }
    if (in_array('brand', $val['styles'])) {
      echo'<div><i class="fab fa-' . $key . ' fa-lg fa-fw"></i></div> ';
    }
    if (in_array('regular', $val['styles'])) {
      echo'<div><i class="far fa-' . $key . ' fa-lg fa-fw"></i><span>unicode: ' . $val['unicode'] . '</span></div> ';
    }
  }

