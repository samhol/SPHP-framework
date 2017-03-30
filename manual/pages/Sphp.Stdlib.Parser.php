<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$arrLink = $php->typeLink("array");
$parser = Apis::apigen()->classLinker(Parser::class);
echo $parsedown->text(<<<MD
##PARSING FILETYPES: <small>reading, writing and transforming</small>

$parser instance can handle file related (reading and writing) operations.
MD
);

CodeExampleBuilder::visualize("Sphp/Filesystem/FileObject1.php", "text", false);