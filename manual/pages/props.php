<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
$array = [1, 2, 3];
echo implode(',', $array), "\n";

foreach ($array as &$value) {}    // by reference
echo implode(',', $array), "\n";

foreach ($array as $value) {}     // by value (i.e., copy)
echo implode(',', $array), "\n";
?>
</pre>
