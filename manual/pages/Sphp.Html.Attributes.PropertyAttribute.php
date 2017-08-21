<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
$abstractAttr = Apis::sami()->classLinker(AbstractAttribute::class);
$propertyAttr = Apis::sami()->classLinker(PropertyAttribute::class);
\Sphp\Manual\parseDown(<<<MD
##The $propertyAttr class
		
The $propertyAttr implements an attribute that contains multiple name 
value pairs as a set of properties. Property names are always unique and a property 
name acts as a key to the corresponding value.
		
The most common example of a property attribute is the `style` attribute. The 
`style` attribute specifies an inline style for an HTML element. The style attribute 
will override any style set globally, e.g. styles specified in the style tag or in an 
external style sheet.

MD
);
CodeExampleBuilder::visualize("Sphp/Html/Attributes/PropertyAttribute.php", "html5", true);
