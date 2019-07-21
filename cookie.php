<?php

//namespace Sphp\Html\Foundation\Sites\Navigation;

require_once('manual/settings.php');

use Sphp\Network\Headers\Cookie;
use Sphp\Network\Headers\Headers;

$headers = new Headers;
//$headers->location('cookie.php');
//$headers->maxAge(60 * 60 * 24 * 7 * 5);
$blaa = $headers->appendNewHeader('blaa-blaa','shiit!');
$headers->save();
//$cookie = (new Cookie('comply_cookie'))->delete();
$cookie1 = $headers->setCookie('blaa-cookie','duh?');
$cookie1->setMaxAge(1222);
$headers->setCookie('set--cookie', 'blib', 4000, 'cookie.php');
$headers->AccessControlMaxAge(444);
$blaa->setValue('öjöjöj');
$blaa->reset();
$blaa->delete();
echo "<pre>";
print_r($_COOKIE);
print_r(headers_list());

$string = 'AccessControlMaxAge';
$patterns = array();
$patterns[0] = '/[A-Z]/';
$patterns[1] = '/brown/';
$patterns[2] = '/fox/';
$replacements = array();
$replacements[2] = '-${0},$3';
$replacements[1] = 'black';
$replacements[0] = 'slow';

$next_year = function($matches) {
  // as usual: $matches[0] is the complete match
  // $matches[1] the match for the first subpattern
  // enclosed in '(...)' and so on
  return '-' . strtolower($matches[0]);
};
echo preg_replace_callback(
        "/(?<!^)[A-Z]/",
        $next_year,
        $string);
//echo preg_replace($patterns, $replacements, $string);
var_dump($headers->containsHeader('Access-Control-Max-Age'));
echo "</pre>";
