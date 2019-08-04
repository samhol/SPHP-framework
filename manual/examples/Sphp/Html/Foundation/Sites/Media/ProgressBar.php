<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\PlainContainer;
use Sphp\Html\Scripts\ScriptSrc;

$progressBars = new PlainContainer();
$progressBars[] = (new ProgressBar(50))->setColor("alert")->setBarName("foobar1");
$progressBars[] = (new ProgressBar(30))->showProgressText(false)->setColor("success")->setBarName("foobar2");

$script = new ScriptSrc("manual/snippets/progressingFooBar.js");
$script->setDefer(true);
$progressBars->printHtml();
$script->printHtml();
