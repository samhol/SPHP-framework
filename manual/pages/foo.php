<?php

use Sphp\Html\Flow\Section;
echo '<a href="foo#new">Add new User accounts</a>';
$section = new Section();
$section->addCssClass('sphp', 'manual', 'vendor-readme-section');
$section->appendArticle()->appendMdFile('vendor/erusev/parsedown/README.md');
$section->appendArticle()->appendMdFile('vendor/zendframework/zend-validator/README.md');
$section->appendArticle()->appendMdFile('vendor/zendframework/zend-stdlib/README.md');
$section->appendArticle()->appendMdFile('vendor/zendframework/zend-i18n/README.md');
$section->appendArticle()->addCssClass('imagine')->appendMdFile('vendor/imagine/imagine/README.md');
$section->printHtml();
?>
<br><br><br><br><br><br><br><br><br><br><br><br>
<h3 id="new">Add new User accounts</h3>