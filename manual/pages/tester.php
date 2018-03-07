<?php

namespace Sphp\Html\Attributes;
echo "<pre>";

$attr = new SequenceAttribute('data-foo');
$attr->set("\n  \t\r   ");
$attr->append([' ', ' ']);
echo "\n$attr";
var_dump($attr->toArray());
$attr->set('a b c d e');
$attr->append(['h', 'k']);
echo "\n$attr";
var_dump($attr->toArray());
$attr->clear();
$attr->set(['fuck,     off']);
$attr->set(['fuck,   d44""" off']);
echo "\n$attr";
var_dump($attr->toArray());

echo "</pre>";
