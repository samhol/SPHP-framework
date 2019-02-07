<?php

namespace Sphp\Html\Media\Icons;
echo '<pre>';
$faGenerator = new FA();
$faGenerator->fixedWidth(true);
$faGenerator->setSize('3x');

echo $faGenerator->android();
$faGenerator->setSize('4x');
echo $faGenerator->facebook('Facebook icon');
$faGenerator->pull('right');
$faGenerator->setSize('lg');
echo $faGenerator->tags('tags icon');

echo '</pre>';