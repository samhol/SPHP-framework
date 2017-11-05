<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;
$attributeManager = Manual\api()->classLinker(AttributeManager::class);
$htmlAttrMngr = Manual\api()->classLinker(HtmlAttributeManager::class);
$attributeInterface = Manual\api()->classLinker(AttributeInterface::class);
$multiValueAttr = Manual\api()->classLinker(MultiValueAttribute::class);
$propertyAttr = Manual\api()->classLinker(PropertyAttribute::class);
$setMethodLink = $attributeManager->methodLink("set", false);
$removeMethodLink = $attributeManager->methodLink("remove", false);
$requireAttr = $attributeManager->methodLink("demand", false);
$protect = $attributeManager->methodLink("protect", false);

Manual\parseDown(<<<MD
##HTML attribute management with $htmlAttrMngr class

The $htmlAttrMngr is the base component for the HTML attribute handling in SPHP 
framework. $htmlAttrMngr has various dedicated methods for different attribute 
types and it is used in all of the HTML components as the attribute handler.

Any type of valid attribute support at least these four setter methods:

1. $setMethodLink: sets an attribute name value pair
2. $removeMethodLink: removes an attribute if possible
3. $requireAttr: This method sets an attribute as always visible (atleast attribute name). A previously nonexistent required 
attribute is stored to the manager as an empty attribute. A required attribute cannot be 
removed, but its value is still mutable.
4. $protect: This method locks an attribute 
to the given value. Locked attribute attribute is always visible. Such attribute cannot be removed and locked value is immune to modification.

**IMPORTANT NOTES ABOUT REQUIRING AND VALUE LOCKING!:** 

1. As default the `style` and `class` attributes can have multiple locked values (Style properties and CSS class names) at 
   the same time and only the locked .
2. other attributes can have only one value as locked at the same time.
3. Attribute can be required and have a locked value at the same time. 

MD
);

Manual\example('Sphp/Html/Attributes/HtmlAttributeManager.php', 'html5', false)
        ->setExamplePaneTitle('HTML attribute manager example')
        ->printHtml();
