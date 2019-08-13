<?php

namespace Sphp\Stdlib\Parsers;

$yaml = new Yaml();
echo $yaml->toString(['foo' => 'bar']);
