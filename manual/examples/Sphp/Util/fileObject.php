<?php

namespace Sphp\Util;

$fileObj = new LocalFile(Config::get("EXAMPLE_DIR") . "/loremIpsum.txt");
echo $fileObj->executeToString();
?>