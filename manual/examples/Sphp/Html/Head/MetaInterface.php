<?php

namespace Sphp\Html\Head;

echo Meta::charset('UTF-8');
echo Meta::description('Foo is fun');
echo Meta::property('foo', 'bar');
echo Meta::httpEquiv('refresh', 30);
echo Meta::author('John Doe');
echo Meta::viewport('width=device-width, initial-scale=1.0');
echo Meta::keywords(['foo', 'bar', 'baz']);
