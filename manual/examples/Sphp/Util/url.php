<?php

namespace Sphp\Objects;

$url = URL::getCurrent(); //current url
$url->setQuery("p1", '"><hr>')
		->setParams(["p|2" => [1,2], "p3" => "v3"]);
echo "'$url'\n";
echo "'" . $url->getHtml() . "'\n";
print_r($url->getArrayCopy());

$url = new URL("http://user:pass@example.com/path/to.file?name1=value 1&name 2=value 2#fragment");
print_r($url->getArrayCopy());

?>