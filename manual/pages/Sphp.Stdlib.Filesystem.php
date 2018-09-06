<?php

namespace Sphp\Stdlib;

use Sphp\Manual;

$arrLink = Manual\php()->typeLink('array');
$fileSystem = Manual\api()->classLinker(Filesystem::class);

Manual\md(<<<MD
##WORKING WITH THE FILESYSTEM: <small>The $fileSystem class</small>

This utility class can handle several local file system related operations.
MD
);

Manual\visualize('Sphp/Filesystem/Filesystem.php', 'text', false);


