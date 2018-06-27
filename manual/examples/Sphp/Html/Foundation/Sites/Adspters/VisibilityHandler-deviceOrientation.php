<?php

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Tags;

$p = Tags::p();
$adapter = new VisibilityAdapter($p);
$adapter->hideForLandscape();
echo $p($p->cssClasses()->getValue());
$adapter->hideForPortrait();
echo $p($p->cssClasses()->getValue());
