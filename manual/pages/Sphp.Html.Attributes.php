<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$abstractAttrMngr = Apis::sami()->classLinker(AbstractAttributeManager::class);
$htmlAttrMngr = Apis::sami()->classLinker(HtmlAttributeManager::class);
$attributeInterface = Apis::sami()->classLinker(AttributeInterface::class);
$multiValueAttr = Apis::sami()->classLinker(MultiValueAttribute::class);
$propertyAttr = Apis::sami()->classLinker(PropertyAttribute::class);
$setMethodLink = $abstractAttrMngr->methodLink("set", false);
$removeMethodLink = $abstractAttrMngr->methodLink("remove", false);
$requireAttr = $abstractAttrMngr->methodLink("demand", false);
$lockAttr = $abstractAttrMngr->methodLink("lock", false);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
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
\Sphp\Manual\loadPage("Sphp.Html.Attributes.AbstractAttribute.php");

\Sphp\Manual\parseDown(<<<MD
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
4. $lockAttr: This method locks an attribute 
to the given value. Locked attribute attribute is always visible. Such attribute cannot be removed and locked value is immune to modification.

**IMPORTANT NOTES ABOUT REQUIRING AND VALUE LOCKING!:** 

1. As default the `style` and `class` attributes can have multiple locked values (Style properties and CSS class names) at 
   the same time and only the locked .
2. other attributes can have only one value as locked at the same time.
3. Attribute can be required and have a locked value at the same time. 

MD
);
