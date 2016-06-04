<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$progressBar = $api->getClassLink(ProgressBar::class);

echo $parsedown->text(<<<MD
		
##The $progressBar component

A $progressBar represents the progress of a task. It is a browser friendly implementation of native HTML 5 progress element.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Media/ProgressBar.php');
