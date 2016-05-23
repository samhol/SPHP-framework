<?php

namespace Sphp\Util;

use Sphp\Html\Apps\SyntaxHighlightingAccordion as SyntaxHighlighter;

$arrLink = $php->getTypeLink("array");
$fileObject = $api->getClassLink(LocalFile::class);
echo $parsedown->text(<<<MD
##The $fileObject class

$fileObject instance can handle file related (reading and writing) operations.
MD
);

$exampleViewer(EXAMPLE_DIR . "Sphp/Util/FileObject1.php", 1, "text");
$exampleViewer(EXAMPLE_DIR . "Sphp/Util/FileObject2.php", 1, "php");

echo $parsedown->text(<<<MD
$fileObject can also read <a href="http://en.wikipedia.org/wiki/Comma-separated_values" target="_blank">CSV-files</a>
to a multidimensional PHP $arrLink where each 'row' represents a data row in the
original CSV-file.
MD
);
(new SyntaxHighlighter())
		->loadFromFile("../snippets/example.csv")
		->setHeading("CSV-file example")
		->printHtml();
$exampleViewer(EXAMPLE_DIR . "Sphp/Util/FileObject3.php", 2);

