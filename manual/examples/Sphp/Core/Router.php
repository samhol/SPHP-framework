<?php

namespace Sphp\Core;

$router = Router::get();

var_dump(
        $router->http(),
        $router->http("manual/"),
        $router->http("sphp/locale/fi_FI/"));

?>
