<?php

namespace Sphp\Stdlib\Networks;

$current = Url::getCurrent();
$clone = clone $current;

$current
        ->setFragment("frag")
        ->setPort(81)
        ->setUser('user')
        ->setPassword('pass')
        ->setPath('path/to.file')
        ->getQuery()
        ->offsetSet('p', 'v');
echo $current->getRaw() . "\n";
echo "$current\n";
echo "$clone\n";
