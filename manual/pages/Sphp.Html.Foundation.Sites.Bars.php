<?php

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$titleBar = Apis::apigen()->classLinker(TitleBar::class);
$topBar = Apis::apigen()->classLinker(\Sphp\Html\Foundation\Sites\Navigation\TopBar::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#Foundation bars: wrappers for navigation components
$ns
This namespace contains Foundation buttons and buttongroups.
They are convenient tools when a centralized style for customized button links and form buttons etc. isneeded.

##The $titleBar implements a Foundation Title Bar

MD
);


CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/TitleBar.php');
echo $parsedown->text(<<<MD
##The $topBar: <small> implementing a Foundation Title Bar</small>
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Buttons/SplitButton.php');
