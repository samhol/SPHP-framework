<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;

$attributeInterface = Manual\api()->classLinker(MutableAttributeInterface::class);
$abstractAttr = Manual\api()->classLinker(AbstractMutableAttribute::class);
$multiValueAttr = Manual\api()->classLinker(MultiValueAttribute::class);

$idAttr = Manual\api()->classLinker(IdAttribute::class);
$attribute = Manual\api()->classLinker(Attribute::class);
$boolAttr = Manual\api()->classLinker(BooleanAttribute::class);

Manual\md(<<<MD
##$attributeInterface<small>basic defintition of all Attribute objects</small>

MD
);
