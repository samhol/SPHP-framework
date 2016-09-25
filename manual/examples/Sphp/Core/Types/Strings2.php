<?php

namespace Sphp\Core\Types;

var_dump(
        Strings::toString(NULL), 
        Strings::toString(pow(2, 50)), 
        Strings::toString(TRUE), 
        Strings::toString(FALSE), 
        Strings::toString([1, 2, "a" => 3]), 
        Strings::toString(new \stdClass()));
?>