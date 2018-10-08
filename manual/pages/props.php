<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
$url = 'http://username:password@hostname:9090/path?arg=value#anchor';

var_dump(parse_url(null));
$parts = [];
$parts[PHP_URL_SCHEME] = parse_url($url, PHP_URL_SCHEME);
$parts[PHP_URL_USER] = parse_url($url, PHP_URL_USER);
$parts[PHP_URL_PASS] = parse_url($url, PHP_URL_PASS);
$parts[PHP_URL_HOST] = parse_url($url, PHP_URL_HOST);
$parts[PHP_URL_PORT] = parse_url($url, PHP_URL_PORT);
$parts[PHP_URL_PATH] = parse_url($url, PHP_URL_PATH);
$parts[PHP_URL_QUERY] = parse_url($url, PHP_URL_QUERY);
$parts[PHP_URL_FRAGMENT] = parse_url($url, PHP_URL_FRAGMENT);
var_dump($parts);
$a = null;
$b = &$a;
$s = 'foo';
var_dump($a, $b);
?>
</pre>
