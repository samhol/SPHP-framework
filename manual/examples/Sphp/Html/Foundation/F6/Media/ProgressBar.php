<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Container;
use Sphp\Html\Document as Document;

$progressBars = new Container();
$progressBars[] = (new ProgressBar(50))->setColor("alert")->setBarName("foobar1");
$progressBars[] = (new ProgressBar(30))->showProgressText(false)->setColor("success")->setBarName("foobar2");

Document::html("manual")->scripts()->appendSrc("manual/snippets/progressingFooBar.js");
$progressBars->printHtml();
?>
