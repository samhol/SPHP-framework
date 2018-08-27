<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\PlainContainer;
use Sphp\Html\Document;

$progressBars = new PlainContainer();
$progressBars[] = (new ProgressBar(50))->setColor("alert")->setBarName("foobar1");
$progressBars[] = (new ProgressBar(30))->showProgressText(false)->setColor("success")->setBarName("foobar2");

Document::html()->scripts()->appendSrc("manual/snippets/progressingFooBar.js");
$progressBars->printHtml();
?>
