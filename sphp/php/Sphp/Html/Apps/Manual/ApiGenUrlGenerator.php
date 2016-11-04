<?php

/**
 * ApiGenUrlGenerator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * ApiGen URL string generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @link    http://www.apigen.org/ ApiGen
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ApiGenUrlGenerator extends UrlGenerator implements ApiUrlGeneratorInterface {

  public function getClassUrl($class) {
    $path = str_replace('\\', '.', $class);
    return $this->create("class-$path.html");
  }

  public function getClassMethodUrl($class, $method) {
    return $this->getClassUrl($class) . '#_' . $method;
  }

  public function getClassConstantUrl($class, $constant) {
    return $this->getClassUrl($class) . '#_' . $constant;
  }

  public function getNamespaceUrl($namespace) {
    $path = str_replace('\\', '.', $namespace);
    return $this->create("namespace-$path.html");
  }

  public function getFunctionUrl($function) {
    return $this->create("function-$function.html");
  }
  
  public function getConstantUrl($constant) {
    $path = str_replace('\\', '.', $constant);
    return $this->createUrl("constant-$path.html");
  }

}
