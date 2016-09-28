<?php

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$btn = Apis::apigen()->classLinker(ButtonInterface::class);
$abstractButton = Apis::apigen()->classLinker(AbstractButton::class);
$formBtn = Apis::apigen()->classLinker(\Sphp\Html\Foundation\F6\Forms\Buttons\InputButton::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);

$btnGroup = Apis::apigen()->classLinker(ButtonGroup::class);
echo $parsedown->text(<<<MD
#Foundation Buttons
$ns
This namespace contains Foundation buttons and buttongroups.
They are convenient tools when a centralized style for customized button links and form buttons etc. isneeded.

##The $btn models a Foundation button

The $btn interface defines required minimun implementation for all Foundation styled Buttons.

Abstract Class $abstractButton is a build in base class extending $btn.
Developers can easily implement a variety of Foundation Buttons by simply extending $abstractButton and 
it is possible in theory to implement any HTML tag as a Foundation Button.

###Styling the $btn buttons

Buttons support predefined Foundation color and size classes and can
also use custom made classes. Colors can be set by calling {$btn->method("setColor", FALSE)}
instance method whereas size can be set by calling {$btn->method("setSize", FALSE)}
instance method with the CSS class name as a parameter value:
MD
);

use Sphp\Html\Foundation\F6\Grids\BlockGrid as BlockGrid;

$blockGrid = (new BlockGrid())->setBlockGrids(1, 1, 2);
$blockGrid->append($parsedown->text(<<<MD
Predefined color classes:

* `NULL` unsets all special button styles (default)
* `'alert'` for alert/error buttons
* `'success'` for ok/success buttons
* `'info'` for information buttons
* `'secondary'` for alternatively styled buttons
* `'disabled'` for disabled buttons
MD
));
$blockGrid->append($parsedown->text("
Predefined size classes:

* `'tiny'` for tiny buttons
* `'small'` for small buttons
* `NULL` for medium buttons (default)
* `'large'` for large buttons
* `'extend'` for extended buttons (takes the full width of the container)
"
));
$blockGrid->printHtml();
echo $parsedown->text(<<<MD
##The {$api->classLinker(HyperlinkButton::class)} and the $formBtn components

1. {$api->classLinker(HyperlinkButton::class)} component implements basic
hyperlink properties from {$api->classLinker(\Sphp\Html\Navigation\HyperlinkInterface::class)}.
2. $formBtn component implements
{$api->classLinker(ButtonInterface::class)} and therefore can be used as a HTML button for any {$api->classLinker(\Sphp\Html\Forms\FormInterface::class)}.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Buttons/Button.php');
echo $parsedown->text(<<<MD
##The {$api->classLinker(SplitButton::class)} component
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Buttons/SplitButton.php');
echo $parsedown->text(<<<MD
##The $btnGroup class

A $btnGroup component is a container for $btn components. A $btnGroup component
is effective for displaying a group of actions in a bar. $btnGroup component works
perfectly with the grid component.

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Buttons/ButtonGroup.php');
$stackFor = $btnGroup->method("stackFor", false);
$unstackFor = $btnGroup->method("unstackFor", false);
echo $parsedown->text(<<<MD

The orientation of a button group can be changed with method $stackFor  that uses 
Foundation stack classes for button groups. Stacking can be removed by using $unstackFor method.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Buttons/ButtonGroup-stackFor.php');
