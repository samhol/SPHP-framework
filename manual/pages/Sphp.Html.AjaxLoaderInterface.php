<?php

namespace Sphp\Html;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingPane as SyntaxHighlightingPane;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$ajaxLoaderInterface = $api->classLinker(AjaxLoaderInterface::class);
$ajaxLoaderTrait = $api->classLinker(AjaxLoaderTrait::class);

echo $parsedown->text(<<<MD
###Ajax loading the content using the $ajaxLoaderInterface
Using AJAX to dynamically load information from a PHP file
MD
);


$pane = (new SyntaxHighlightingPane())
        ->loadFromFile("manual/snippets/loremipsum.html")
        ->setPaneTitle("Original HTML source file used in Ajax loading");

$ex = new CodeExampleBuilder("Sphp/Html/AjaxLoaderInterface.php", "html5");
$ex->prepend($pane)->printHtml();
