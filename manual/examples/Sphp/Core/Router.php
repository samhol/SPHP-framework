<?php

namespace Sphp\Core;

$router = Router::get();

var_dump(
        $router->http(), 
        $router->http(Router::SPHP), 
        $router->http("manual/"),
        $router->http(Router::SPHP_CSS), 
        $router->http("sphp/locale/fi_FI/"));

?>
