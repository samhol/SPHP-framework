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
class ApiGenClassUrlGenerator extends AbstractClassUrlGenerator {

  public function getClassPath() {
    $path = str_replace('\\', '.', $this->reflector()->getName());
    return "{$this->getRoot()}class-$path.html";
  }

  public function getMethodPath($method) {
    return $this->getClassPath() . '#_' . $method;
  }

  public function getConstantPath($constant) {
    return $this->getClassPath() . '#_' . $constant;
  }

  public function getNamespacePath() {
    $ns = $this->reflector()->getNamespaceName();
    $path = str_replace('\\', '.', $ns);
    return "{$this->getRoot()}namespace-$path.html";
  }

}
