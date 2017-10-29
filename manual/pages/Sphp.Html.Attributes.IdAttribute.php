<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;

$attributeInterface = Manual\api()->classLinker(AttributeInterface::class);
$abstractAttr = Manual\api()->classLinker(AbstractAttribute::class);
$multiValueAttr = Manual\api()->classLinker(MultiValueAttribute::class);

$idAttribute = Manual\api()->classLinker(IdentityAttribute::class);
$attr= Manual\api()->classLinker(Attribute::class);
$boolAttr = Manual\api()->classLinker(BooleanAttribute::class);


Manual\parseDown(<<<MD
##$idAttribute object <small>for unique HTML element ids</small>

MD
);

Manual\example('Sphp/Html/Attributes/IdAttribute.php', "html5", false)
        ->setExamplePaneTitle('Examples of attributes with multiple atomic values')
        ->printHtml();











