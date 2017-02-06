<?php

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$titleBar = Apis::apigen()->classLinker(TitleBar::class);
$topBar = Apis::apigen()->classLinker(TopBar::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#Foundation bars: <small>wrappers for navigation components</small>
$ns
This namespace contains Foundation buttons and buttongroups.
They are convenient tools when a centralized style for customized button links and form buttons etc. isneeded.

##Foundation Title Bar: <small>The $titleBar component</small>

MD
);


CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/TitleBar.php');
echo $parsedown->text(<<<MD
##Foundation Top Bar: <small>The $topBar component</small>
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Buttons/SplitButton.php');
