<?php

namespace Sphp\Html\Foundation\F6\Buttons;

use \Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$buttonNamespace = $api->getNamespaceLink(__NAMESPACE__);
$btn = $api->classLinker(ButtonInterface::class);
$abstractButton = $api->getClassLink(AbstractButton::class);
$formBtn = $api->classLinker(Button::class);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##Foundation Buttons
$ns
The $buttonNamespace namespace contains Foundation buttons, buttongroups and buttonbars.
They are convenient tools when a centralized style for customized button links and form buttons etc. isneeded.

##The $btn interface

The $btn interface defines required minimun implementation for all Foundation styled Buttons.

Abstract Class $abstractButton is a build in base class extending $btn.
Developers can easily implement a variety of Foundation Buttons by simply extending $abstractButton.
With $abstractButton it is possible in theory to implement any HTML tag as a Foundation Button.

###Styling the $btn buttons

Buttons support predefined Foundation color and size classes and can
also use custom made classes. Colors can be set by calling {$btn->method("setColor", FALSE)}
instance method whereas size can be set by calling {$btn->method("setSize", FALSE)}
instance method with the CSS class name as a parameter value:
MD
);

use Sphp\Html\Foundation\F6\Core\BlockGrid as BlockGrid;

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
$blockGrid->append($parsedown->text(<<<MD
Predefined size classes:

* `'tiny'` for tiny buttons
* `'small'` for small buttons
* `NULL` for medium buttons (default)
* `'large'` for large buttons
* `'extend'` for extended buttons (takes the full width of the container)
MD
));
$blockGrid->printHtml();
echo $parsedown->text(<<<MD
##The {$api->getClassLink(HyperlinkButton::class)} and the $formBtn components

1. {$api->getClassLink(HyperlinkButton::class)} component implements basic
hyperlink properties from {$api->getClassLink(\Sphp\Html\Navigation\HyperlinkInterface::class)}.
2. $formBtn component implements
{$api->getClassLink(ButtonInterface::class)} and therefore can be used as a HTML button for any {$api->getClassLink(\Sphp\Html\Forms\FormInterface::class)}.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Buttons/Button.php');
echo $parsedown->text(<<<MD
##The {$api->getClassLink(SplitButton::class)} component
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Buttons/SplitButton.php');
$btnGroup = $api->getClassLink(ButtonGroup::class);
echo $parsedown->text(<<<MD
##The $btnGroup class

A $btnGroup component is a container for $btn components. A $btnGroup component
is effective for displaying a group of actions in a bar. $btnGroup component works
perfectly with the grid component.

The orientation of a button group can be changed with the Foundation stack classes.

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Buttons/ButtonGroup.php');
