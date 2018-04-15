<?php

namespace Sphp\Stdlib\Parsers;

$yaml = new Yaml();
echo $yaml->encodeArray(['foo' => 'bar']);
