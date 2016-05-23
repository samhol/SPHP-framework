<?php

namespace Sphp\Html\Attributes;

$attrChanger = $api->classLinker(AttributeChanger::class);
$attrChangeObserver = $api->classLinker(AttributeChangeObserver::class);
$multiValueAttr = $api->classLinker(MultiValueAttribute::class);
$setMethod = $abstractAttr->method("set");
$clearMethod = $abstractAttr->method("clear");
$requireMethod = $abstractAttr->method("setRequired");
$lockMethod = $abstractAttr->method("lock");

echo $parsedown->text(<<<MD
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
$load("Sphp.Html.Attributes.IdentifyingAttribute.php");
$load("Sphp.Html.Attributes.MultiValueAttribute.php");
$load("Sphp.Html.Attributes.PropertyAttribute.php");

