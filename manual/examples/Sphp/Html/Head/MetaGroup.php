<?php

namespace Sphp\Html\Head;

use Sphp\Stdlib\Parser;

echo HeadFactory::fromArray(Parser::fromFile("Sphp/Html/Head/meta.yaml"));
