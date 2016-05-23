<?php

namespace Sphp\Html\Foundation\Content;
use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$panel = $api->classLinker(Panel::class);
echo $parsedown->text(<<<MD
###The $panel component
		
$panel panel is a Foundation based component that makes it possible to outline 
sections of a web page. The width of a $panel is controlled by the size of their 
container.
		
MD
);

CodeExampleViewer::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/Content/Panel.php');
