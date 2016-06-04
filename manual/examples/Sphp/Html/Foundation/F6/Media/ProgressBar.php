<?php

namespace Sphp\Html\Foundation\F6\Media;
use Sphp\Html\Container as Container;

$progressBars = new Container();
$progressBars[] = (new ProgressBar(50))->setColor("alert");
$progressBars[] = new ProgressBar(30);
$progressBars[] = new ProgressBar(20);
$progressBars->printHtml();
?>
