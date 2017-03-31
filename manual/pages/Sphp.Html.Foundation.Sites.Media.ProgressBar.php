<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingPane;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$progressBar = $api->classLinker(ProgressBar::class);

echo $parsedown->text(<<<MD
		
##The $progressBar component

A $progressBar represents the progress of a task. It is a browser friendly implementation of native HTML 5 progress element.
A $progressBar component can be used in conjunction with JavaScript to display the progress of a task.
MD
);
$fooBarCodePane = new SyntaxHighlightingPane('<code>progressingFooBar.js</code> JavaScript code');
$fooBarCodePane->loadFromFile('manual/snippets/progressingFooBar.js');
$example = (new CodeExampleBuilder('Sphp/Html/Foundation/F6/Media/ProgressBar.php', false, true))
        ->buildAccordion()
        ->prepend($fooBarCodePane)
        ->printHtml();
