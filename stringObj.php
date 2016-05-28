<?php

namespace Sphp\Core\Types;

header('Content-Type: text/html; charset=utf-8');
require_once("manual/settings.php");

echo "<pre>";
$so = new StaticStringy("abcdefghijklmnopqrstyvwxyzåäö", "UTF-8");
var_dump($so->contains("c"));


var_dump($so->containsAll(["c", "a", "fgh"]));
var_dump($so->length());
var_dump($so->charAt(3));
