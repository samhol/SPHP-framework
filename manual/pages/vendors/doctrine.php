<?php

use Sphp\Html\Flow\Section;

$section = new Section();
$section->addCssClass('sphp', 'manual', 'vendor-readme-section', $vendorName);
$section->appendArticle()->appendMdFile('vendor/doctrine/common/README.md');
$section->appendArticle()->appendMdFile('vendor/doctrine/cache/README.md');
$section->appendArticle()->appendMdFile('vendor/doctrine/orm/README.md');
$section->appendArticle()->appendMdFile('vendor/doctrine/dbal/README.md');
$section->appendArticle()->appendMdFile('vendor/doctrine/reflection/README.md');
$section->printHtml();
