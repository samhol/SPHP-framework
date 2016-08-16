<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;
$htmlAttrMngr = $api->classLinker(AttributeManager::class);
$abstractAttr = $api->classLinker(AbstractAttribute::class);
$multiValueAttr = $api->classLinker(MultiValueAttribute::class);
$propertyAttr = $api->classLinker(PropertyAttribute::class);
$setMethodLink = $htmlAttrMngr->method("set");
$removeMethodLink = $htmlAttrMngr->method("remove");
$requireAttr = $htmlAttrMngr->method("demand");
$lockAttr = $htmlAttrMngr->method("lock");
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#HTML ATTRIBUTE MANAGEMENT

        
$ns	

An HTML attribute is a modifier of an HTML element. Particular attributes are 
only supported by particular element types.

Some attributes are required attributes, needed by particular element types for 
them to function correctly; while in other cases they are optional attributes. 
Standard attributes are supported by a large number of element types.
MD
);
$load("Sphp.Html.Attributes.AbstractAttribute.php");

echo $parsedown->text(<<<MD
##HTML attribute management with $htmlAttrMngr class

The $htmlAttrMngr is the base component for the HTML attribute handling in SPHP 
framework. $htmlAttrMngr has various dedicated methods for different attribute 
types and it is used in all of the HTML components as the attribute handler.

Any type of valid attribute support at least these four setter methods:

1. **Setting a name value pair**:
  * $setMethodLink
2. **removing**:
  * $removeMethodLink
3. **Requiring** (attribute is always existent in the manager and cannnot directly be removed):
  * $requireAttr
4. **Value locking** (attribute is always existent and has a certain value and cannnot directly be removed):
  * $lockAttr
MD
);
$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Attributes/AttributeManager1.php", "html5", true);
$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Attributes/AttributeManager2.php", "html5", true);
echo $parsedown->text(<<<MD
##Requiring attributes and locking attribute values

$requireAttr method forces or unforces
an attribute name to exists in the string output of the $htmlAttrMngr. A previously nonexistent required 
attribute is stored to the manager as an empty attribute. A required attribute cannot be 
removed, but its value is mutable.
		
$lockAttr method locks an attribute 
to the given value. A locked attribute cannot be removed and its value is immune to modification.

**IMPORTANT NOTES ABOUT REQUIRING AND VALUE LOCKING!:** 

1. As default the `style` and `class` attributes can have multiple locked values (Style properties and CSS class names) at 
   the same time and only the locked .
2. other attributes can have only one value as locked at the same time.
3. Attribute can be required and have a locked value at the same time. 

MD
);
$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Attributes/AttributeManager2.php", "html5", true);

