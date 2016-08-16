<?php

namespace Sphp\Html\Foundation\F6\Navigation;

use Sphp\Html\Foundation\F6\Containers\Accordions\SyntaxHighlightingSingleAccordion as SyntaxHighlightingSingleAccordion;
use Sphp\Html\Navigation\HyperlinkInterface as HyperlinkInterface;

$hyperlinkIfLink = $api->classLinker(HyperlinkInterface::class);
$drilldownMenu = $api->classLinker(DrilldownMenu::class);
echo $parsedown->text(<<<MD
##The $drilldownMenu component

The $drilldownMenu component is one of Foundation's three menu patterns, which converts a series of nested lists into a vertical drilldown menu.
MD
);
?>
<div class="row small-up-2 media-up-2">
<div class="columns" >
<?php
include EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/DrilldownMenu.php';
?>
</div>
<div class="columns" >
<?php
include EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/DrilldownMenu.php';
?>
</div>
</div>
<?php

SyntaxHighlightingSingleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/DrilldownMenu.php');
