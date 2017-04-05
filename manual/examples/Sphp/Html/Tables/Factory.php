<?php

namespace Sphp\Html\Tables;

use Sphp\Stdlib\CsvFile;

echo Factory::fromCsvFile(new CsvFile('manual/snippets/1000.csv'), 10, 5);

echo Factory::fromCsvFile(new CsvFile('manual/snippets/1000.csv'), 0, 10);
?>