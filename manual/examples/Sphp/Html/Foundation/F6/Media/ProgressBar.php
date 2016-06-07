<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Container as Container;
use Sphp\Html\Document as Document;

$progressBars = new Container();
$progressBars[] = (new ProgressBar(50))->setColor("alert")->setBarName("foobar1");
$progressBars[] = (new ProgressBar(30))->setColor("success")->setBarName("foobar2");

Document::html()->scripts()->appendSrc("manual/snippets/progressingFooBar.js");
$progressBars->printHtml();
?>
