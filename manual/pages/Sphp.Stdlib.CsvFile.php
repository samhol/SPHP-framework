<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$csvFile = Apis::apigen()->classLinker(CsvFile::class);
$arrLink = Apis::phpManual()->typeLink('array');
echo $parsedown->text(<<<MD
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
$codeExample = (new CodeExampleBuilder('manual/snippets/example.csv'))
        ->setHtmlFlowVisibility(false)
        ->setOutpputHighlighting(false)
        ->setExamplePaneTitle('CSV-file example')
        ->printHtml();
$codeExample->setPath('Sphp/Filesystem/CsvFile.php')
        ->setHtmlFlowVisibility(true)
        ->setExamplePaneTitle('PHP script converting a CSV-file to an HTML table')
        ->setOutputPaneTitle('CSV data as a HTML table')
        ->printHtml();
//CodeExampleBuider::visualize('Sphp/Filesystem/CsvFile.php', false, true);
//CodeExampleBuider::visualize('Sphp/Filesystem/CsvFile.php', false, true);