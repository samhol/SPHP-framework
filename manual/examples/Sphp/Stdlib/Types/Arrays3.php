<?php

namespace Sphp\Stdlib;

use Sphp\Stdlib\Networks\URL;

$arr = [["a", "b"], 'url' => new URL("http://sphp.samiholck.com/?page=tools")];
$copy = Arrays::copy($arr);
$arr['url']->setQuery("a=1&b=2");
echo $arr['url'] . "\n";
echo $copy['url'];
