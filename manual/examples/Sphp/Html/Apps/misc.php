<?php

namespace Sphp\Html\Apps;

$stamp = new DateStamp(new \DateTime());
echo $stamp;
$backToTop = new BackToTopButton(new \Sphp\Html\Span('back to top'));
echo $backToTop;
