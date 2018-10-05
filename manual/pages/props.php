<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
//var_dump(parse_url(null));
//var_dump($url = new \Sphp\Stdlib\Networks\URL('https://john.doe:pass@www.example.com:123/forum/questions/?tag=networking&order=newest#top'));
//var_dump($url1 = new \Sphp\Stdlib\Networks\URL('http://www.example.com'));
//$url1[PHP_URL_PORT] = 5;
//var_dump($url1[PHP_URL_PORT]);
//var_dump($url2 = new \Sphp\Stdlib\Networks\URL('mailto:sami.holck@samiholck.com'));
var_dump($url3 = new \Sphp\Stdlib\Networks\URL('forum/questions/?tag=networking&order=newest#top'));
//var_dump(PHP_URL_SCHEME);
/*print_r($url->toArray());
var_dump($url->getHtml());
var_dump($url->setUsername('sami.holck') === $url);
$url->getQuery()->set('p3', "<script>alert('hello')</script>");
$url->setFragment("<script>alert('hello')</script>");
var_dump($url->getHtml());*/
?>
</pre>
