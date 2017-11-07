<?php

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Apps\Manual\Sami\Sami;
use Sphp\Html\Apps\Manual\Sami\SamiUrlGenerator;
use Sphp\Html\Apps\Manual\ApiGen\ApiGen;
use Sphp\Html\Apps\Manual\ApiGen\ApiGenUrlGenerator;
use Sphp\Html\Apps\Manual\PHPManual\PHPManual;

$di = new \Pimple\Container();

$di['api'] = function ($c) {
  $instance = new Sami(new SamiUrlGenerator('API/sami/'), 'sami');
  $instance->setDefaultTarget('sami');
  return $instance;
};

/**
 * Returns a singleton instance of PHPManual API linker
 * 
 * @return PHPManual singleton API linker
 */
$di['php-manual'] = function ($c) {
  return new PHPManual('phpman');
};
