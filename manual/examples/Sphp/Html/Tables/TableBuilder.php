<?php

namespace Sphp\Html\Tables;

$bodyData = [
    ['Sami', 'Holck', 'sami.holck@gmail.com', 'http://samiholck.com'],
    ['John', 'Doe', 'john.doe@unknown.no', '-'],
];
$labels = ['First name', 'Last name', 'Email', 'Homepage'];
$builder = new TableBuilder();
$builder->setTbodyData($bodyData);
$builder->setTheadData($labels);
$builder->setTfootData($labels);
$labeller = new Labeller($labels);
$builder->addTableFilter($labeller);
$linenumberer = new LineNumberer();
$linenumberer->prependLineNumbers(true);
$builder->addTableFilter($linenumberer);
//$builder->getLineNumberer()->prependLineNumbers(true);
$builder->printHtml();
