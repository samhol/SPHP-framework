<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;

$multiValueAttr = Manual\api()->classLinker(MultiValueAttribute::class);
$classAttribute = Manual\api()->classLinker(ClassAttribute::class);
\Sphp\Manual\md(<<<MD
##The $multiValueAttr class

The $multiValueAttr implements an attribute that can contain multiple separate 
atomic values. 

$classAttribute :
  : The most common example of such an attribute is the `class` attribute which 
    specifies one or more classnames for an HTML component. This attribute is mostly 
    used to point to a class in a style sheet. However, it can also be used by a 
    JavaScript statement to make changes to HTML elements with a specified class.
   
MD
);
Manual\example("Sphp/Html/Attributes/ClassAttribute.php", "html5", true)
        ->setExamplePaneTitle('Usage example of class attribute')
        ->printHtml();

