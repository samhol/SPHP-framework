<?php

namespace Sphp\Stdlib\Parsers;

$yaml = new Yaml();
echo $yaml->encodeData(['foo' => 'bar']);
