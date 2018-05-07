<?php

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\TagFactory;

$p = TagFactory::p();
$adapter = new VisibilityAdapter($p);
$adapter->hideForLandscape();
echo $p($p->cssClasses()->getValue());
$adapter->hideForPortrait();
echo $p($p->cssClasses()->getValue());
