<?php

namespace Sphp\Html\Head;

use Sphp\Stdlib\Parsers\ParseFactory;

echo HeadFactory::fromArray(ParseFactory::yaml()->fileToArray("manual/examples/Sphp/Html/Head/meta.yaml"));
