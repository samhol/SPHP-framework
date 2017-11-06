<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;

$php = Apis::phpManual();
$arrLink = $php->typeLink("array");
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#LOCAL FILESYSTEM MANIPULATION: <small>reading, writing and transforming</small>{#FileSystem}
$ns
MD
);
\Sphp\Manual\loadPage('Sphp.Stdlib.Filesystem');
\Sphp\Manual\loadPage('Sphp.Stdlib.Parser');
\Sphp\Manual\loadPage('Sphp.Stdlib.CsvFile');

