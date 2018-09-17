<?php

namespace Sphp\Html\Media;

$fig = (new Figure("http://placehold.it/350x150/0f0/fff", "Empty placeholder image"));
$fig->getImg()->setLazy();
$fig->printHtml();
