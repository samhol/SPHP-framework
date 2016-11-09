<?php

namespace Sphp\Net;

$current = Url::getCurrent();
$clone = clone $current;

$current
        ->setFragment("frag")
        ->setParam('p', 'v')
        ->setPort(81)
        ->setUser('user')
        ->setPassword('pass')
        ->setPath('path/to.file');
echo $current->getRaw() . "\n";
echo "$current\n";
echo "$clone\n";
?>
