<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$arrLink = Apis::phpManual()->typeLink('array');
$fileSystem = \Sphp\Manual\api()->classLinker(Filesystem::class);
\Sphp\Manual\parseDown(<<<MD
##WORKING WITH THE FILESYSTEM: <small>The $fileSystem class</small>{#FileSystem_FileSystem}

This utility class can handle several local file system related operations.
MD
);

CodeExampleBuilder::visualize("Sphp/Filesystem/Filesystem.php", null, false);


