<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;

echo "<pre>";
echo new ImmutableScalarAttribute('foo', true) . "\n";
echo new ImmutableScalarAttribute('foo', false) . "\n";
echo new ImmutableScalarAttribute('foo', 0) . "\n";
echo new ImmutableScalarAttribute('foo', 'pussy ass nigga') . "\n";
echo new ImmutableScalarAttribute('foo', '') . "\n";
echo new ImmutableScalarAttribute('foo', "\n") . "\n";
echo "</pre>";



