<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#HTML attribute management
    
$ns	

An HTML attribute is a modifier of an HTML element. Particular attributes are 
only supported by particular element types.

Some attributes are required attributes, needed by particular element types for 
them to function correctly; while in other cases they are optional attributes. 
Standard attributes are supported by a large number of element types.
MD
);

Manual\printPage('Sphp.Html.Attributes.AttributeInterface');
Manual\printPage('Sphp.Html.Attributes.AttributeManager');
