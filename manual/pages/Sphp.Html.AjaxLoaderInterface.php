<?php

namespace Sphp\Html;

use Sphp\Html\Foundation\F6\Containers\Accordions\SyntaxHighlightingPane as SyntaxHighlightingPane;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$ajaxLoaderInterface = $api->getClassLink(AjaxLoaderInterface::class);
$ajaxLoaderTrait = $api->getClassLink(AjaxLoaderTrait::class);

echo $parsedown->text(<<<MD
###Ajax loading the content using the $ajaxLoaderInterface
Using AJAX to dynamically load information from a PHP file
MD
);


$pane = (new SyntaxHighlightingPane())
        ->loadFromFile("manual/snippets/loremipsum.html")
		->setPaneTitle("Original HTML source file used in Ajax loading");

$ex = new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Html/AjaxLoaderInterface.php", "html5ssss");
$ex->prepend($pane)->printHtml();
