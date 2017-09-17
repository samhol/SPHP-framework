<?php

namespace Sphp\Stdlib;

$router = Path::get();

var_dump(
        $router->http(),
        $router->http("manual/"),
        $router->http("sphp/locale/fi_FI/"));
