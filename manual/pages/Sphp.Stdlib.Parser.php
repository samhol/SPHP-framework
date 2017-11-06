<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$arrLink = Apis::phpManual()->typeLink("array");
$parser = \Sphp\Manual\api()->classLinker(Parser::class);
\Sphp\Manual\parseDown(<<<MD
##PARSING FILETYPES: <small>reading, writing and transforming</small>

$parser instance can handle file related (reading and writing) operations.
MD
);

CodeExampleBuilder::visualize("Sphp/Filesystem/FileObject1.php", "text", false);
