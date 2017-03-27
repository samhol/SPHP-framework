<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;

$php = Apis::phpManual();
$arrLink = $php->typeLink("array");
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#LOCAL FILESYSTEM MANIPULATION: <small>reading, writing and transforming</small>{#FileSystem}
$ns
MD
);
$load('Sphp.Stdlib.Filesystem');
$load('Sphp.Stdlib.Parser');
$load('Sphp.Stdlib.CsvFile');

