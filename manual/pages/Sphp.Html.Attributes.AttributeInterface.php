<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;

$attributeInterface = Manual\api()->classLinker(Attribute::class);
$abstractAttr = Manual\api()->classLinker(AbstractAttribute::class);

$idAttr = Manual\api()->classLinker(IdAttribute::class);
$attr= Manual\api()->classLinker(GeneralAttribute::class);
$boolAttr = Manual\api()->classLinker(BooleanAttribute::class);
$setMethod = $attributeInterface->methodLink('setValue');
$clearMethod = $attributeInterface->methodLink('clear');
$requireMethod = $attributeInterface->methodLink('forceVisibility');
$lockMethod = $attributeInterface->methodLink('protectValue');

Manual\md(<<<MD
##HTML attribute objects <small>implementing $attributeInterface</small>
		
Framework defines an abstract $abstractAttr that implements the $attributeInterface. All build in attribute
classes are derived from $abstractAttr.

Any attribute class support at least these four value manipulation methods:

1. **Setting an attribute values**: $setMethod
2. **Requiring** (atleast attribute name is always existent in the output): $requireMethod
3. **Value locking**: $lockMethod
   * Notes: attribute is always existent and contains atleast the locked value(s) and cannnot be removed
4. **Clearing non locked attribute values**: $clearMethod

MD
);


Manual\printPage('Sphp.Html.Attributes.IdAttribute');
Manual\printPage('Sphp.Html.Attributes.BooleanAttribute');
//\Sphp\Manual\loadPage('Sphp.Html.Attributes.AbstractScalarAttribute');
Manual\printPage('Sphp.Html.Attributes.MultiValueAttribute');
Manual\printPage('Sphp.Html.Attributes.PropertyAttribute');


Manual\example('Sphp/Html/Attributes/AttributeInterface.php', "html5", true)
        ->setExamplePaneTitle('Examples of scalar attributes')
        ->printHtml();











