<?php

namespace Sphp\Tools;

use Sphp\Objects\URL as URL;

$arr = [["a", "b"], 'url' => new URL("http://sphp.samiholck.com/?page=tools")];
$copy = ArrayUtils::copy($arr);
$arr['url']->setQuery("a=1&b=2");
echo $arr['url'] . "\n";
echo $copy['url'];
?>