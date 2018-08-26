<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\Component;
use Sphp\Manual;

$componentInterface = \Sphp\Manual\api()->classLinker(Component::class);
$buttonInterface = \Sphp\Manual\api()->classLinker(ButtonInterface::class);
$buttonAdapter = \Sphp\Manual\api()->classLinker(Button::class);
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$btnGroup = \Sphp\Manual\api()->classLinker(ButtonGroup::class);
\Sphp\Manual\md(<<<MD
#Foundation Buttons
$ns
This namespace contains Foundation buttons and buttongroups.
They are convenient tools when a centralized style for customized button links and form buttons etc. isneeded.

##The $buttonInterface <small> For Foundation styled button</small>

Interface defines required minimun implementation for all Foundation styled Buttons.
Buttons support predefined Foundation color and size classes and can
also use custom made classes. Colors can be set by calling {$buttonInterface->methodLink("setColor", FALSE)}
instance method whereas size can be set by calling {$buttonInterface->methodLink("setSize", FALSE)}
instance method with the CSS class name as a parameter value:
MD
);

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$blockGrid = new BlockGrid(['small-up-1', 'large-up-2']);
$blockGrid->appendMd(<<<MD
Predefined color classes:

* `NULL` unsets all special button styles (default)
* `'alert'` for alert/error buttons
* `'success'` for ok/success buttons
* `'info'` for information buttons
* `'secondary'` for alternatively styled buttons
* `'disabled'` for disabled buttons
MD
);
$blockGrid->appendMd(<<<MD
Predefined size classes:

* `'tiny'` for tiny buttons
* `'small'` for small buttons
* `NULL` for medium buttons (default)
* `'large'` for large buttons
* `'extend'` for extended buttons (takes the full width of the container)
"
MD
);
$blockGrid->printHtml();

Manual\md(<<<MD
##$buttonAdapter <small>Converts anything to button style</small>

This adapter can transform most $componentInterface objects to Foundation styled buttons.
MD
);
$splitButton = \Sphp\Manual\api()->classLinker(SplitButton::class);

Manual\visualize('Sphp/Html/Foundation/Sites/Buttons/Button.php');

Manual\md(<<<MD
##The $splitButton component
MD
);

Manual\visualize('Sphp/Html/Foundation/Sites/Buttons/SplitButton.php');

Manual\md(<<<MD
##The $btnGroup class

A $btnGroup component is a container for $buttonInterface components. A $btnGroup component
is effective for displaying a group of actions in a bar. $btnGroup component works
perfectly with the grid component.

MD
);

Manual\visualize('Sphp/Html/Foundation/Sites/Buttons/ButtonGroup.php');

$stackFor = $btnGroup->methodLink("stackFor", false);
$unstackFor = $btnGroup->methodLink("unstackFor", false);

Manual\md(<<<MD
The orientation of a button group can be changed with method $stackFor  that uses 
Foundation stack classes for button groups. Stacking can be removed by using $unstackFor method.

MD
);

Manual\visualize('Sphp/Html/Foundation/Sites/Buttons/ButtonGroup-stackFor.php');
