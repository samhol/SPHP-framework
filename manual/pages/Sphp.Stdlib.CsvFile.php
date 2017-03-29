<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Manual\MVC\CodeExampleAccordion;

$csvFile = Apis::apigen()->classLinker(CsvFile::class);
$arrLink = Apis::phpManual()->typeLink('array');
echo $parsedown->text(<<<MD
$csvFile can read and modify <a href="http://en.wikipedia.org/wiki/Comma-separated_values" target="_blank">CSV-files</a>
to a multidimensional PHP $arrLink where each 'row' represents a data row in the
original CSV-file.
MD
);
(new CodeExampleAccordion())
        ->fromFile(EXAMPLE_DIR . "../snippets/example.csv")
        ->setExampleHeading("CSV-file example")
        ->printHtml();
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Filesystem/CsvFile.php", false, true);
