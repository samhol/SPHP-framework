<?php

use Sphp\Html\Flow\Section;

$section = new Section();
$section->addCssClass('sphp', 'manual', 'vendor-readme-section', $vendorName);
$section->appendArticle()->appendMdFile('vendor/zendframework/zend-validator/README.md');
$section->appendArticle()->appendMdFile('vendor/zendframework/zend-stdlib/README.md');
$section->appendArticle()->appendMdFile('vendor/zendframework/zend-i18n/README.md');
$section->appendArticle()->appendMdFile('vendor/zendframework/zend-mail/README.md');
$section->printHtml();
