<?php

namespace Sphp\Core;

echo"<pre>";
//var_dump($_SERVER);

//print_r(Configuration::useDomain("manual")->localPaths()->toArray());
//print_r(Configuration::useDomain("manual")->httpPaths()->toArray());
$router = Path::get();
var_dump(
        $router->http(), 
        $router->http("manual/"),
        $router->http("sphp/locale/fi_FI/"), 
        $router->local());
echo"</pre>";
