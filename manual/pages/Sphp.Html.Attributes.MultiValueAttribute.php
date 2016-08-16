<?php

namespace Sphp\Html\Attributes;

$abstractAttr = $api->classLinker(AbstractAttribute::class);
$multiValueAttr = $api->classLinker(MultiValueAttribute::class);
echo $parsedown->text(<<<MD
##The $multiValueAttr class
		
The $multiValueAttr implements an attribute that can contain multiple separate 
atomic values. 
	
The most common example of such an attribute is the `class` attribute which 
specifies one or more classnames for an HTML component. This attribute is mostly 
used to point to a class in a style sheet. However, it can also be used by a 
JavaScript statement to make changes to HTML elements with a specified class.

MD
);
$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Attributes/MultiValueAttribute.php", "html5", true);