<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators\Sami;

use Sphp\Html\Apps\HyperlinkGenerators\UrlGenerator;
use Sphp\Html\Apps\HyperlinkGenerators\ApiUrlGeneratorInterface;

/**
 * URL string generator pointing to an existing Sami documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://github.com/FriendsOfPHP/Sami Sami: an API documentation generator
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SamiUrlGenerator extends UrlGenerator implements ApiUrlGeneratorInterface {

  public function getClassUrl(string $class): string {
    $path = str_replace('\\', '/', $class);
    return $this->createUrl("$path.html");
  }

  public function getClassMethodUrl(string $class, string $method): string {
    return $this->getClassUrl($class) . '#method_' . $method;
  }

  public function getClassConstantUrl(string $class, string $constant): string {
    return $this->getClassUrl($class);
  }

  public function getNamespaceUrl(string $namespace): string {
    $path = str_replace('\\', '/', $namespace);
    return $this->createUrl("$path.html");
  }

  public function getFunctionUrl(string $function): string {
    return $this->createUrl("function-$function.html");
  }

  public function getConstantUrl(string $constant): string {
    $path = str_replace('\\', '.', $constant);
    return $this->createUrl("constant-$path.html");
  }

}
