<?php

namespace Sphp\Html;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingPane;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;

$ajaxLoaderInterface = \Sphp\Manual\api()->classLinker(AjaxLoader::class);
$ajaxLoaderTrait = \Sphp\Manual\api()->classLinker(AjaxLoaderTrait::class);

\Sphp\Manual\md(<<<MD
###Ajax loading the content using the $ajaxLoaderInterface
Using AJAX to dynamically load information from a PHP file
MD
);


$pane = (new SyntaxHighlightingPane())
        ->loadFromFile('manual/snippets/loremipsum.html')
        ->setPaneTitle('Original HTML source file used in Ajax loading');

$ex = (new CodeExampleAccordionBuilder('Sphp/Html/AjaxLoaderInterface.php', 'html5'))
        ->buildAccordion();
$ex->prepend($pane)->printHtml();
