<?php

namespace Sphp\Net;

$url = new Url("https://example.com/");
echo "'$url'\n";
$url->setParam("p1", [0, 1])
        ->setParams(["p2" => "v2", "p3" => "<script>"]);
echo "'$url'\n";
$url->unsetParam("p2")
        ->unsetParam("p3")
        ->setParam("p1", "v1")
        ->setPath("path/to.file");
echo "'$url'\n";
$url->setFragment("fragment")
        ->setPort(100)
        ->setUser("user")
        ->setPassword("pass");
echo "'$url'\n";

$url1 = new URL("https://user:pass@example.com:100/path/to.file?p1=v1#fragment");
echo "urls are equal: " . var_export($url->equals($url1), true);
?>