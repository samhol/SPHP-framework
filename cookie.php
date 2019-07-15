<?php

//namespace Sphp\Html\Foundation\Sites\Navigation;

require_once('manual/settings.php');

use Sphp\Network\Cookies\Cookie;

$cookie = (new Cookie('comply_cookie'))->delete();
$cookie1 = new Cookie('blaa-cookie');
$cookie1->setMaxAge(1222);
$cookie1->setValue('duh?');
$cookie1->save();
echo "<pre>";
print_r($_COOKIE);
var_dump($_COOKIE);
echo "</pre>";
