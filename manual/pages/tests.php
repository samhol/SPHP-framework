<?php

namespace Sphp\Core;

echo"<pre>";
//var_dump($_SERVER);

//print_r(Configuration::useDomain("manual")->localPaths()->toArray());
//print_r(Configuration::useDomain("manual")->httpPaths()->toArray());
$paths = Configuration::current()->paths();
var_dump(
        $paths->http(), 
        $paths->http(PathFinder::SPHP), 
        $paths->http("manual/"),
        $paths->http(PathFinder::SPHP_CSS), 
        $paths->http("sphp/locale/fi_FI/"), 
        $paths->local(), 
        $paths->local(PathFinder::SPHP));
echo"</pre>";
