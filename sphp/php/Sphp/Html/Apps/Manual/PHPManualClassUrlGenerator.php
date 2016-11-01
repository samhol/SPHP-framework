<?php

/**
 * PHPManualClassPathParser.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * PHP class link generator pointing to an exising PHP Manual documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PHPManualClassUrlGenerator extends AbstractClassUrlGenerator {

  use PHPManualTrait;

  public function getClassPath() {
    return $this->getRoot() . "class." . $this->phpPathFixer($this->reflector()->getName()) . '.php';
  }

  public function getMethodPath($method) {
    return $this->phpPathFixer($this->reflector()->getName()) . ".$method.php";
  }

  public function getConstantPath($constant) {
    $className = $this->reflector()->getName();
    $constantName = $this->phpPathFixer($constant);
    return $this->getClassPath() . "#$className.constants.$constantName";
  }

  public function getNamespacePath() {
    $ns = $this->reflector()->getNamespaceName();
    $path = str_replace('\\', '.', $ns);
    return "namespace-$path.html";
  }

  /**
   * Sets the language of the PHP documentation
   * 
   * @param  string $lang two letter language code 
   * @return self for PHP Method Chaining
   */
  public function setLanguage($lang) {
    $url = preg_replace('~[a-z]{2}\/$~', "$lang/", $this->getRoot());
    $this->setRoot($url);
    return $this;
  }

}
