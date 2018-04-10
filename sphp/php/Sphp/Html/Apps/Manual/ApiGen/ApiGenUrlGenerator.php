<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Manual\ApiGen;

use Sphp\Html\Apps\Manual\UrlGenerator;
use Sphp\Html\Apps\Manual\ApiUrlGeneratorInterface;

/**
 * ApiGen URL string generator pointing to an existing ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.apigen.org/ ApiGen
 * @license https://opensource.org/licenses/MIT The MIT License
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
