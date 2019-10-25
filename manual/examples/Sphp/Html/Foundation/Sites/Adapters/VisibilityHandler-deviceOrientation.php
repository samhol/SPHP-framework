<?php

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Tags;

$p = Tags::p();
$adapter = new VisibilityAdapter($p);
$adapter->hideForLandscape();
echo $p->resetContent($p->cssClasses());
$adapter->hideForPortrait();
echo $p->resetContent($p->cssClasses());
