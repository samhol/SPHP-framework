<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
$p = new PatternAttribute('coords', '/^([0-9]+,){2}[0-9]+$/');
$p->setValue('2,0,34');
echo $p;
echo '</pre>';

