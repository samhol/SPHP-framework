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
class ApiGenClassUrlGenerator extends UrlGenerator implements ClassUrlGeneratorInterface {

  public function getClassPath($className) {
    $path = str_replace('\\', '.', $className);
    return $this->create("class-$path.html");
  }

  public function getMethodPath($className, $method) {
    return $this->getClassPath($className) . '#_' . $method;
  }

  public function getConstantPath($className, $constant) {
    return $this->getClassPath($className) . '#_' . $constant;
  }

  public function getNamespacePath($namespaceName) {
    $path = str_replace('\\', '.', $namespaceName);
    return "{$this->getRoot()}namespace-$path.html";
  }

}
