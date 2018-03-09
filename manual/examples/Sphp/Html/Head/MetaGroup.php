<?php

namespace Sphp\Html\Head;

use Sphp\Stdlib\Parser;

echo MetaGroup::fromArray(Parser::fromFile("manual/snippets/meta-data.yaml"));
