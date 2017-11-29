<?php

namespace Sphp\Stdlib;

use Sphp\Manual;

$csvFile = Manual\api()->classLinker(CsvFile::class);
$arrLink = Manual\php()->typeLink('array');
Manual\parseDown(<<<MD
$csvFile can read and modify <a href="http://en.wikipedia.org/wiki/Comma-separated_values" target="_blank">CSV-files</a>
to a multidimensional PHP $arrLink where each 'row' represents a data row in the
original CSV-file.
MD
);
//echo get_include_path();
//include ('foo.php');
//include "Sphp/Filesystem/CsvFile.php";
//var_dump(stream_resolve_include_path("Sphp/Filesystem/CsvFile.php"));
//$f = new \SplFileInfo("Sphp/Filesystem/CsvFile.php");
//var_dump($f->isFile());
Manual\example('manual/snippets/example.csv', null, false)
        ->setExamplePaneTitle('CSV-file example')
        ->printHtml();
Manual\example('Sphp/Filesystem/CsvFile.php')
        ->setExamplePaneTitle('PHP script converting a CSV-file to an HTML table')
        ->setOutputPaneTitle('CSV data as a HTML table')
        ->printHtml();
