<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingPane;
use Sphp\Manual;

$progressBar = Manual\api()->classLinker(ProgressBar::class);

Manual\md(<<<MD

##The $progressBar component

A $progressBar represents the progress of a task. It is a browser friendly implementation of native HTML 5 progress element.
A $progressBar component can be used in conjunction with JavaScript to display the progress of a task.
MD
);
$fooBarCodePane = new SyntaxHighlightingPane('<code>progressingFooBar.js</code> JavaScript code');
$fooBarCodePane->loadFromFile('manual/snippets/progressingFooBar.js');
\Sphp\Manual\example('Sphp/Html/Foundation/Sites/Media/ProgressBar.php', null, true)
        ->buildAccordion()
        ->prepend($fooBarCodePane)
        ->printHtml();
