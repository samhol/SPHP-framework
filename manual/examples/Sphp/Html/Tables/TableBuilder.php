<?php

namespace Sphp\Html\Tables;

$bodyData = [
    ['Sami', 'Holck', 'sami.holck@gmail.com', 'http://samiholck.com'],
    ['John', 'Doe', 'john.doe@unknown.no', '-'],
];
$builder = new TableBuilder();
$builder->setTbodyData($bodyData);
$builder->printHtml();
$builder->setTheadData(['First name', 'Last name', 'Email', 'Homepage']);
$builder->setTfootData(['First name', 'Last name', 'Email', 'Homepage']);
$builder->getLineNumberer()->prependLineNumbers(true);
$builder->printHtml();
