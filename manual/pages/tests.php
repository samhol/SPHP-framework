<?php

namespace Sphp\Db\Objects;

echo"<pre>";

$ar = array(
    array(1, 3),
    array(1, 2),
    array(3, 3),
    array(2, 122),
);

array_multisort($ar[0], SORT_ASC, SORT_STRING, $ar[1], SORT_NUMERIC, SORT_DESC);
var_dump($ar);
echo"</pre>";
