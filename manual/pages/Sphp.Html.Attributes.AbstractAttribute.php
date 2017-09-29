<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Apps\Manual\Apis;

$abstractAttr = Apis::sami()->classLinker(AbstractAttribute::class);
$multiValueAttr = Apis::sami()->classLinker(MultiValueAttribute::class);
$setMethod = $abstractAttr->methodLink("set");
$clearMethod = $abstractAttr->methodLink("clear");
$requireMethod = $abstractAttr->methodLink("demand");
$lockMethod = $abstractAttr->methodLink("lock");

\Sphp\Manual\parseDown(<<<MD
##Complex HTML attributes
		
Framework defines an abstract class $abstractAttr from which the complex attribute
classes are derived. As default the `class` and `style` attributes.

Any attribute class extending $abstractAttr support at least these four value manipulation methods:

1. **Setting an attribute values**: $setMethod
2. **Requiring** (atleast attribute name is always existent in the output): $requireMethod
3. **Value locking**: $lockMethod
   * Notes: attribute is always existent and contains atleast the locked value(s) and cannnot be removed
4. **Clearing non locked attribute values**: $clearMethod
MD
);

\Sphp\Manual\loadPage('Sphp.Html.Attributes.MultiValueAttribute');
\Sphp\Manual\loadPage('Sphp.Html.Attributes.PropertyAttribute');

