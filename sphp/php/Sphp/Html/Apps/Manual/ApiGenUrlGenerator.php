<?php

/**
 * ApiGenClassPathParser.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * PHP class link generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ApiGenUrlGenerator extends UrlGenerator implements PHPApiUrlGeneratorInterface {

  public function getClassUrl($className) {
    $path = str_replace('\\', '.', $className);
    return $this->create("class-$path.html");
  }

  public function getClassMethodUrl($className, $method) {
    return $this->getClassUrl($className) . '#_' . $method;
  }

  public function getClassConstantUrl($className, $constant) {
    return $this->getClassUrl($className) . '#_' . $constant;
  }

  public function getNamespaceUrl($namespaceName) {
    $path = str_replace('\\', '.', $namespaceName);
    return $this->create("namespace-$path.html");
  }

  public function getFunctionUrl($funName) {
    return $this->create("function-$funName.html");
  }
  
  public function getConstantUrl($constant) {
    $path = str_replace('\\', '.', $constant);
    return $this->createUrl("constant-$path.html");
  }

}
