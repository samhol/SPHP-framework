<?php

namespace Sphp\Html\Lists;

$dl = (new Dl())
        ->appendTerms("Numbers:")
        ->appendDescriptions(["zero", "one", "two", "three", "four"])
        ->printHtml();
