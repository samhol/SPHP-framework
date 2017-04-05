<?php

namespace Sphp\Html\Tables;

$bodyData = [
    ['Sami', 'Holck', 'sami.holck@gmail.com', 'http://samiholck.com'],
    ['John', 'Doe', 'john.doe@unknown.no', '-'],
];
$builder = new TableBuilder();
$builder->setTheadData([['First name', 'Last name', 'Email', 'Homepage']]);
$builder->setTbodyData($bodyData);

$builder->printHtml();
$builder->setTfootData([['First name', 'Last name', 'Email', 'Homepage']]);
$builder->setLineNumbers(1, 'left');
$builder->printHtml();
?>