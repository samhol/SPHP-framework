<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;

$attributeInterface = Manual\api()->classLinker(AttributeInterface::class);
$abstractAttr = Manual\api()->classLinker(AbstractAttribute::class);
$multiValueAttr = Manual\api()->classLinker(MultiValueAttribute::class);

$idAttr = Manual\api()->classLinker(IdAttribute::class);
$attribute = Manual\api()->classLinker(Attribute::class);
$boolAttr = Manual\api()->classLinker(BooleanAttribute::class);


Manual\parseDown(<<<MD
##$attributeInterface<small>basic defintition of all Attribute objects</small>

MD
);


Manual\loadPage('Sphp.Html.Attributes.IdAttribute');
Manual\loadPage('Sphp.Html.Attributes.BooleanAttribute');

Manual\example('Sphp/Html/Attributes/AttributeInterface.php', "html5", true)
        ->setExamplePaneTitle('Examples of scalar attributes')
        ->printHtml();










