<?php

namespace Sphp\Stdlib\Datastructures;

$data = new DataObject();
$data['options']['default'] = 3;
$data['options']['min_range'] = 1;
$data['options']['max_range'] = 10;
$data['flags'] = FILTER_FLAG_ALLOW_OCTAL;
print_r($data->toArray());

$data1 = new DataObject();
$data1->options->default = 3;
$data1->options->min_range = 1;
$data1->options->max_range = 10;
$data1->options->max_range = 10;
$data1->flags = FILTER_FLAG_ALLOW_OCTAL;
print_r($data1->toArray());
unset($data1->options->max_range);
print_r($data1->toArray());
