<?php

namespace Sphp\Filesystem;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion as SyntaxHighlighter;

$arrLink = $php->typeLink("array");
$fileObject = Apis::apigen()->classLinker(LocalFile::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#LOCAL FILESYSTEM: <small>reading, writing and transforming</small>{#FileSystem}
$ns
MD
);
$load('Sphp.Filesystem.Filesystem');
$load('Sphp.Filesystem.Parser');
echo $parsedown->text(<<<MD
##The $fileObject class

$fileObject instance can handle file related (reading and writing) operations.
MD
);
$exampleViewer(EXAMPLE_DIR . "Sphp/Filesystem/FileObject1.php", "text", false);
$exampleViewer(EXAMPLE_DIR . "Sphp/Filesystem/FileObject2.php", "text", false);

$load('Sphp.Filesystem.CsvFile');

