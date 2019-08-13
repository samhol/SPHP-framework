<?php

namespace Sphp\Stdlib;

include '../settings.php';
use Sphp\Stdlib\Parsers\ParseFactory;
echo ParseFactory::fromFile('manual/snippets/techs.html', 'md');
