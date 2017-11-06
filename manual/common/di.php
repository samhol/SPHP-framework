<?php

namespace Pimple;
use Sphp\Html\Apps\Manual\Sami\Sami;
$di = new Container();


$di['api'] = function ($c) {
    return new Sami(new \Sphp\Html\Apps\Manual\Sami\SamiUrlGenerator(''));
};
