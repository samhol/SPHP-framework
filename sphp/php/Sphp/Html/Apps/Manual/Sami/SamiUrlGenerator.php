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

  /**
   * {@inheritdoc}
   */
  public function getClassUrl($class) {
    $path = str_replace('\\', '/', $class);
    return $this->create("$path.html");
  }

  /**
   * {@inheritdoc}
   */
  public function getClassMethodUrl($class, $method) {
    return $this->getClassUrl($class) . '#method_' . $method;
  }

  /**
   * {@inheritdoc}
   */
  public function getClassConstantUrl($class, $constant) {
    return $this->getClassUrl($class);
  }

  /**
   * {@inheritdoc}
   */
  public function getNamespaceUrl($namespace) {
    $path = str_replace('\\', '/', $namespace);
    return $this->create("$path.html");
  }

  /**
   * {@inheritdoc}
   */
  public function getFunctionUrl($function) {
    return $this->create("function-$function.html");
  }
  
  /**
   * {@inheritdoc}
   */
  public function getConstantUrl($constant) {
    $path = str_replace('\\', '.', $constant);
    return $this->createUrl("constant-$path.html");
  }

}
