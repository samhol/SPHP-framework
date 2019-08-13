<?php

namespace Sphp\Stdlib;

$php = \Sphp\Manual\php();
$arrLink = $php->typeLink("array");
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\md(<<<MD
# FILE Manipulation{#FileSystem}
$ns
MD
);
\Sphp\Manual\printPage('Sphp.Stdlib.Filesystem');
\Sphp\Manual\printPage('Sphp.Stdlib.Parsers');
\Sphp\Manual\printPage('Sphp.Stdlib.CsvFile');

