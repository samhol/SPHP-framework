<?php

namespace Sphp\Stdlib\Parsers;

$yaml = new Yaml();
echo $yaml->write(['foo' => 'bar']);
