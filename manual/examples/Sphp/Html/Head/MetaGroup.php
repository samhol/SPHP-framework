<?php

namespace Sphp\Html\Head;

use Sphp\Stdlib\Parsers\Parser;

echo HeadFactory::fromArray(Parser::yaml()->readFromFile("manual/examples/Sphp/Html/Head/meta.yaml"));
