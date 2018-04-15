<?php

namespace Sphp\Stdlib\Parsers;

use Sphp\Manual;
use Sphp\Stdlib\Parser;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$phpArray = Manual\php()->typeLink('array');
$parser = Manual\api()->classLinker(Parser::class);
Manual\md(<<<MD
#PARSING  <small>reading, writing and transforming</small>
$ns
$parser instance can handle file related (reading and writing) operations.
MD
);

Manual\loadPage('Sphp.Stdlib.Parsers.Yaml');
Manual\loadPage('Sphp.Stdlib.Parsers.Json');
Manual\loadPage('Sphp.Stdlib.Parsers.Markdown');
