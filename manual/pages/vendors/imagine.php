<?php

use Sphp\Html\Flow\Section;

$section = new Section();
$section->addCssClass('sphp', 'manual', 'vendor-readme-section', $vendorName);
$section->appendArticle()->appendMdFile('vendor/imagine/imagine/README.md');
$section->printHtml();
