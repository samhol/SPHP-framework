<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Manual;

$callout = \Sphp\Manual\api()->classLinker(ContentCallout::class);
\Sphp\Manual\md(<<<MD
## The $callout component
		
$callout is a Foundation 6 based component that makes it possible to outline 
sections of a web page. The width of a $callout is controlled by the size of their 
container.
		
MD
);

Manual\example('Sphp/Html/Foundation/Sites/Containers/Callout.php')->printHtml();
