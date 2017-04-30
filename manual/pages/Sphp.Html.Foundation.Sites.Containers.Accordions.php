<?php

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

//$ns = $api->namespaceLink(__NAMESPACE__);
$paneInterface = Apis::apigen()->classLinker(PaneInterface::class);
$accordion = Apis::apigen()->classLinker(Accordion::class);

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
        
##The $accordion container for $paneInterface components
$ns
>The graphical control element **accordion** is a vertically stacked list of items, 
such as labels or thumbnails. Each item can be "expanded" or "stretched" to reveal 
the content associated with that item. There can be zero expanded items, exactly 
one, or more than one item expanded at a time, depending on the configuration.
<cite>Wikipedia</cite>

MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/Accordions/Accordions.php');

