<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;

$attributeInterface = Manual\api()->classLinker(AttributeInterface::class);
$abstractAttr = Manual\api()->classLinker(AbstractAttribute::class);
$multiValueAttr = Manual\api()->classLinker(MultiValueAttribute::class);

$idAttr = Manual\api()->classLinker(IdentityAttribute::class);
$attribute = Manual\api()->classLinker(Attribute::class);
$boolAttr = Manual\api()->classLinker(BooleanAttribute::class);


Manual\parseDown(<<<MD
##$attribute object <small>implementing $attributeInterface</small>

MD
);

Manual\example('Sphp/Html/Attributes/Attribute.php', 'html5', true)
        ->setExamplePaneTitle('Examples of attributes with multiple atomic values')
        ->printHtml();

Manual\loadPage('Sphp.Html.Attributes.IdAttribute');
Manual\loadPage('Sphp.Html.Attributes.BooleanAttribute');











