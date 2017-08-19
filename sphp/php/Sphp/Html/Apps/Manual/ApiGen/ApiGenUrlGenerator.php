<?php

/**
 * ApiGenUrlGenerator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual\ApiGen;

use Sphp\Html\Apps\Manual\UrlGenerator;
use Sphp\Html\Apps\Manual\ApiUrlGeneratorInterface;

/**
 * ApiGen URL string generator pointing to an existing ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @link    http://www.apigen.org/ ApiGen
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ApiGenUrlGenerator extends UrlGenerator implements ApiUrlGeneratorInterface {

  public function getClassUrl(string $class): string {
    $path = str_replace('\\', '.', $class);
    return $this->create("class-$path.html");
  }

  public function getClassMethodUrl(string $class, string $method): string {
    return $this->getClassUrl($class) . "#_$method";
  }

  public function getClassConstantUrl(string $class, string $constant): string {
    return $this->getClassUrl($class) . "#_$constant";
  }

  public function getNamespaceUrl(string $namespace): string {
    $path = str_replace('\\', '.', $namespace);
    return $this->create("namespace-$path.html");
  }

  public function getFunctionUrl(string $function): string {
    return $this->create("function-$function.html");
  }

  public function getConstantUrl(string $constant): string {
    $path = str_replace('\\', '.', $constant);
    return $this->create("constant-$path.html");
  }

}
