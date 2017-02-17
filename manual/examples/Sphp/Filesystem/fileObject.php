<?php

namespace Sphp\Filesystem;

$fileObj = new LocalFile(Config::get("EXAMPLE_DIR") . "/loremIpsum.txt");
echo $fileObj->executeToString();
?>