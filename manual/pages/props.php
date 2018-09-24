<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
$span = new \Sphp\Html\Span();
$span->appendMd('foo');
$div = new \Sphp\Html\Div();
$div->appendMd('foo');
echo $span;

echo $div;
?>
</pre>
