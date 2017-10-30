<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#HTML ATTRIBUTE MANAGEMENT
    
$ns	

An HTML attribute is a modifier of an HTML element. Particular attributes are 
only supported by particular element types.

Some attributes are required attributes, needed by particular element types for 
them to function correctly; while in other cases they are optional attributes. 
Standard attributes are supported by a large number of element types.
MD
);
Manual\loadPage('Sphp.Html.Attributes.AttributeInterface');
Manual\loadPage('Sphp.Html.Attributes.AttributeManager');
