<?php

namespace Sphp\Html\Tables;

use  Sphp\Stdlib\Parsers\CsvFile;

echo TableBuilder::fromCsvFile(new CsvFile('manual/snippets/1000.csv'), 10, 5);

echo TableBuilder::fromCsvFile(new CsvFile('manual/snippets/1000.csv'), 0, 10);
?>
