<?php

namespace Sphp\Html\Attributes;

$identifyingAttr = $api->classLinker(IdentifyingAttribute::class);
$abstractAttr = $api->getClassLink(AbstractAttribute::class);
$setMethodLink = $api->getClassMethodLink(AttributeManager::class, "set");
$removeMethodLink = $api->getClassMethodLink(AttributeManager::class, "remove");
echo $parsedown->text(<<<MD
##The $identifyingAttr class
		
The $identifyingAttr implements an attribute that specifies a unique id for an html element. 
The value of this attribute must be unique within the HTML document.



MD
);
$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Attributes/IdentifyingAttribute.php", "html5", false);