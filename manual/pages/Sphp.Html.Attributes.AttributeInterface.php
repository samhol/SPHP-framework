<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;

$attributeInterface = Manual\api()->classLinker(AttributeInterface::class);
$abstractAttr = Manual\api()->classLinker(AbstractAttribute::class);
$multiValueAttr = Manual\api()->classLinker(MultiValueAttribute::class);

$idAttr = Manual\api()->classLinker(IdentityAttribute::class);
$attr= Manual\api()->classLinker(Attribute::class);
$boolAttr = Manual\api()->classLinker(BooleanAttribute::class);
$setMethod = $abstractAttr->methodLink("set");
$clearMethod = $abstractAttr->methodLink("clear");
$requireMethod = $abstractAttr->methodLink("demand");
$lockMethod = $abstractAttr->methodLink("lock");

Manual\parseDown(<<<MD
##HTML attribute objects <small>implementing $attributeInterface</small>
		
Framework defines an abstract $abstractAttr that implements the $attributeInterface. All build in attribute
classes are derived from $abstractAttr.

Any attribute class support at least these four value manipulation methods:

1. **Setting an attribute values**: $setMethod
2. **Requiring** (atleast attribute name is always existent in the output): $requireMethod
3. **Value locking**: $lockMethod
   * Notes: attribute is always existent and contains atleast the locked value(s) and cannnot be removed
4. **Clearing non locked attribute values**: $clearMethod
        
        
Some build in attributes implementing $attributeInterface:
        
* $abstractAttr
  * $attr
  * $boolAttr
  * $idAttr
* 
MD
);

\Sphp\Manual\loadPage('Sphp.Html.Attributes.Attribute');
\Sphp\Manual\loadPage('Sphp.Html.Attributes.MultiValueAttribute');
\Sphp\Manual\loadPage('Sphp.Html.Attributes.PropertyAttribute');











