<?php

/**
 * SamiUrlGenerator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual\Sami;

use Sphp\Html\Apps\Manual\UrlGenerator;
use Sphp\Html\Apps\Manual\ApiUrlGeneratorInterface;

/**
 * URL string generator pointing to an existing Sami documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @link    https://github.com/FriendsOfPHP/Sami Sami: an API documentation generator
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SamiUrlGenerator extends UrlGenerator implements ApiUrlGeneratorInterface {

  public function getClassUrl(string $class): string {
    $path = str_replace('\\', '/', $class);
    return $this->create("$path.html");
  }

  public function getClassMethodUrl(string $class, string $method): string {
    return $this->getClassUrl($class) . '#method_' . $method;
  }

  public function getClassConstantUrl(string $class, string $constant): string {
    return $this->getClassUrl($class);
  }

  public function getNamespaceUrl(string $namespace): string {
    $path = str_replace('\\', '/', $namespace);
    return $this->create("$path.html");
  }

  public function getFunctionUrl(string $function): string {
    return $this->create("function-$function.html");
  }

  public function getConstantUrl(string $constant): string {
    $path = str_replace('\\', '.', $constant);
    return $this->createUrl("constant-$path.html");
  }

}
