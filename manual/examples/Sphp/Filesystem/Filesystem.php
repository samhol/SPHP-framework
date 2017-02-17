<?php

namespace Sphp\Filesystem;

echo Filesystem::toString(__FILE__);
print_r(Filesystem::getTextFileRows(__FILE__));
print_r(Filesystem::dirToArray(__DIR__ . '/foo'));
?>