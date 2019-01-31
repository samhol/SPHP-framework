<?php

use Sphp\Html\Flow\Section;

$section = new Section();
$section->addCssClass('sphp', 'manual', 'vendor-readme-section');
$section->appendArticle()->appendMdFile('vendor/erusev/parsedown/README.md');
$section->appendArticle()->appendMdFile('vendor/zendframework/zend-validator/README.md');
$section->appendArticle()->appendMdFile('vendor/zendframework/zend-stdlib/README.md');
$section->appendArticle()->appendMdFile('vendor/zendframework/zend-i18n/README.md');
$section->appendArticle()->addCssClass('imagine')->appendMdFile('vendor/imagine/imagine/README.md');
$section->printHtml();
