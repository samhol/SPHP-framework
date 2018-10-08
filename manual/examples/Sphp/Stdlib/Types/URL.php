<?php

namespace Sphp\Stdlib\Networks;

$current = Url::getCurrent();
$clone = clone $current;

$current
        ->setPart(PHP_URL_FRAGMENT, "frag")
        ->setPart(PHP_URL_PORT, 81)
        ->setPart(PHP_URL_USER, 'user')
        ->setPart(PHP_URL_PASS, 'pass')
        ->setPart(PHP_URL_PATH, 'path/to.file')
        ->setPart(PHP_URL_QUERY, 'a=b&c=d')
        ->getQuery()
        ->offsetSet('p', 'v');
echo $current->getRaw() . "\n";
echo "$current\n";
echo "$clone\n";
