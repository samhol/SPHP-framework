<?php

namespace Sphp\Html\Tables;

$bodyData = [
    ['Sami', 'Holck', 'sami.holck@gmail.com', 'http://samiholck.com'],
    ['John', 'Doe', 'john.doe@unknown.no', '-'],
];
$builder = new TableBuilder();
$builder->setTheadData([['First name', 'Last name', 'Email', 'Homepage'], ['First name', 'Last name', 'Email', 'Homepage']]);
$builder->setTbodyData($bodyData);
$lineNumberer = new LineNumberer(1, 'index');
$builder->setLineNumberer($lineNumberer);

//$builder->printHtml();
//$builder->setTfootData([['First name', 'Last name', 'Email', 'Homepage']]);
//$builder->setLineNumbers(1, 'left');
$table = $builder->buildTable();
echo $table;
