<?php

namespace Sphp\Stdlib;

$str = new MbString("Hello! I am a string.\n");

echo $str->convertCase(MB_CASE_LOWER);
echo $str->convertCase(MB_CASE_UPPER);
echo $str->convertCase(MB_CASE_TITLE);
echo $str->reverse()->trim();
echo "\n" . $str[0] . $str[1] . $str[2] . $str[3] . $str[4];

