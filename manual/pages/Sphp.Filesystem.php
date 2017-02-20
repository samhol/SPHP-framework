<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;

$arrLink = $php->typeLink("array");
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#LOCAL FILESYSTEM: <small>reading, writing and transforming</small>{#FileSystem}
$ns
MD
);
$load('Sphp.Filesystem.Filesystem');
$load('Sphp.Filesystem.Parser');
$load('Sphp.Filesystem.CsvFile');

