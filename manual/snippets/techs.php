<?php

namespace Sphp\Stdlib;

include '../settings.php';
use Sphp\Stdlib\Parsers\Parser;
echo Parser::fromFile('manual/snippets/techs.html', 'md');
