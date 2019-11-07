<?php

use Sphp\Html\Flow\Section;

$section = new Section();
$section->addCssClass('sphp', 'manual', 'vendor-readme-section');
$section->appendArticle()->appendMdFile('./manual/pages/vendors/md/misc/imagine.md');
$section->printHtml();
