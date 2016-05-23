<?php

namespace Sphp\Core;

$paths = new PathFinder();

var_dump(
        $paths->http(), 
        $paths->http(PathFinder::SPHP), 
        $paths->http("manual/"),
        $paths->http(PathFinder::SPHP_CSS), 
        $paths->http("sphp/locale/fi_FI/"), 
        $paths->local(), 
        $paths->local(PathFinder::SPHP));

?>
