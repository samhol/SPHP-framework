<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$arrLink = Apis::phpManual()->typeLink('array');
$fileSystem = Apis::apigen()->classLinker(FileSystem::class);
echo $parsedown->text(<<<MD
##WORKING WITH THE FILESYSTEM: <small>The $fileSystem class</small>{#FileSystem_FileSystem}

This utility class can handle several local file system related operations.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Filesystem/Filesystem.php", false, false);


