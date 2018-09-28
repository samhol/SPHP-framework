<?php

namespace Sphp\Stdlib;

$foo = ['foo' => 'bar', 'is not' => 'foobar', '!' => '!'];
echo Arrays::implodeWithKeys($foo, ' ', ' ');
