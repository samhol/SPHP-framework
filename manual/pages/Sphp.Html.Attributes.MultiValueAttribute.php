<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$abstractAttr = Apis::sami()->classLinker(AbstractAttribute::class);
$multiValueAttr = Apis::sami()->classLinker(MultiValueAttribute::class);
\Sphp\Manual\parseDown(<<<MD
##The $multiValueAttr class
		
The $multiValueAttr implements an attribute that can contain multiple separate 
atomic values. 
	
The most common example of such an attribute is the `class` attribute which 
specifies one or more classnames for an HTML component. This attribute is mostly 
used to point to a class in a style sheet. However, it can also be used by a 
JavaScript statement to make changes to HTML elements with a specified class.

MD
);
CodeExampleBuilder::visualize("Sphp/Html/Attributes/MultiValueAttribute.php", "html5", true);
