<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Foundation\F6\Containers\Accordions\SyntaxHighlightingPane as SyntaxHighlightingPane;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Core\PathFinder as PathFinder;

$progressBar = $api->classLinker(ProgressBar::class);

echo $parsedown->text(<<<MD
		
##The $progressBar component

A $progressBar represents the progress of a task. It is a browser friendly implementation of native HTML 5 progress element.
A $progressBar component can be used in conjunction with JavaScript to display the progress of a task.
MD
);
$fooBarCodePane = new SyntaxHighlightingPane("<code>progressingFooBar.js</code> JavaScript code");
$fooBarCodePane->loadFromFile((new PathFinder)->local("manual/snippets/progressingFooBar.js"));
$example = new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Media/ProgressBar.php', false, true);
$example->prepend($fooBarCodePane);
$example->printHtml();
