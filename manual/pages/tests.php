<?php

namespace Sphp\Core;

echo"<pre>";
//var_dump($_SERVER);

//print_r(Configuration::useDomain("manual")->localPaths()->toArray());
//print_r(Configuration::useDomain("manual")->httpPaths()->toArray());
$router = Configuration::current()->paths();
var_dump(
        $router->http(), 
        $router->http(Router::SPHP), 
        $router->http("manual/"),
        $router->http(Router::SPHP_CSS), 
        $router->http("sphp/locale/fi_FI/"), 
        $router->local(), 
        $router->local(Router::SPHP));
echo"</pre>";
