<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;
use Sphp\Html\IdentifiableComponent;
$identifiableInterface = Manual\api()->classLinker(IdentifiableComponent::class);
$idAttribute = Manual\api()->classLinker(IdAttribute::class);


Manual\parseDown(<<<MD
##$idAttribute object <small>for unique HTML element ids</small>

The id attribute specifies a unique id for an HTML element (the value must be unique within the HTML document).
This attribute is used when identifying $identifiableInterface components.
MD
);











