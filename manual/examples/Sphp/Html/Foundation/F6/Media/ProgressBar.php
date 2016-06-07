<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Container as Container;
use Sphp\Html\Programming\ScriptSrc as ScriptSrc;

$progressBars = new Container();
$progressBars[] = (new ProgressBar(50))->setColor("alert")->setBarName("foobar");
$progressBars[] = new ProgressBar(30);
$progressBars[] = (new ScriptSrc("manual/snippets/progressBars.js"));
$progressBars->printHtml();
?>
