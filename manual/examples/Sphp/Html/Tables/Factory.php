<?php

namespace Sphp\Html\Tables;

echo Factory::fromCsvFile('manual/snippets/1000.csv', ',', 10, 20);

echo Factory::fromCsvFile('manual/snippets/1000.csv', ',', 0, 20);
?>