<?php

namespace Sphp\Html\Attributes;

use Sphp\Manual;

$boolAttr = Manual\api()->classLinker(BooleanAttribute::class);

Manual\parseDown(<<<MD
##$boolAttr object <small>for boolean attributes</small>

MD
);
