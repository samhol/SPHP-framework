<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
//print_r(get_defined_constants(true));
print_r($url = new \Sphp\Stdlib\Networks\URL1('https://john.doe:pass@www.example.com:123/forum/questions/?tag=networking&order=newest#top'));
var_dump(PHP_URL_PATH);
var_dump(PHP_URL_SCHEME);
var_dump($url->getHtml());
var_dump($url->setUsername('sami.holck'));
$url->getQuery()->set('p3', "<script>alert('hello')</script>");
$url->setFragment("<script>alert('hello')</script>");
var_dump($url->getHtml());
?>
</pre>
