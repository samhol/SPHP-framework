<?php

namespace Sphp\Html\Head;

use Sphp\Stdlib\Parsers\Parser;

echo HeadFactory::fromArray(Parser::yaml()->arrayFromFile("manual/examples/Sphp/Html/Head/meta.yaml"));
