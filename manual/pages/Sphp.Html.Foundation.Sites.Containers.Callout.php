<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$callout = $api->classLinker(Callout::class);
echo $parsedown->text(<<<MD
###The $callout component
		
$callout is a Foundation 6 based component that makes it possible to outline 
sections of a web page. The width of a $callout is controlled by the size of their 
container.
		
MD
);

CodeExampleBuilder::visualize('Sphp/Html/Foundation/F6/Containers/Callout.php');
