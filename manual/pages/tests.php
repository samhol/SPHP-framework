<?php

namespace Sphp\Stdlib\Networks;

$url = new URL("https://username:password@www.example.com/path?param1=value1&param2=value2&bool#fragment");
$q = new QueryString("https://username:password@www.example.com/path?param1=value1&param2=value2&bool#fragment");
$q1 = QueryString::fromGET(\FILTER_SANITIZE_STRING);
$q2 = QueryString::getCurrent(\FILTER_SANITIZE_STRING);
$q2->merge($q1)->merge(['foo' => ['bar', 'baar']]);
echo "<pre>";
print_r($q->toArray());

print_r($q1->toArray());

print_r($q2->toArray());
echo $q2->set('xss', '<script>alert("foo")</script>')->getHtml();
print_r($url->setQuery($q1)->toArray());
echo $url->getHtml();
?>
</pre>
