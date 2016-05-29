<?php

namespace Sphp\Core\Types;

header('Content-Type: text/html; charset=utf-8');
require_once("manual/settings.php");

echo "<pre>";
$so = new StringObject(" abcd\tefghijklmn  opqrstyvwx    yzåäö \n", "UTF-8");
echo $so;
var_dump($so->contains("c"));


var_dump($so->containsAll(["c", "a", "fgh"]));
var_dump($so->length());
var_dump($so->charAt(3));
var_dump($so[3]);
var_dump("".$so->between(4, 7));
var_dump("". $so->collapseWhitespace());
