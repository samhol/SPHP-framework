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
class PHPManualClassUrlGenerator extends UrlGenerator implements ClassUrlGeneratorInterface {

  use PHPManualTrait;
  
  public function __construct($lang = 'en') {
    parent::__construct('https://secure.php.net/manual/en/');
  }

  public function getClassPath($classname) {
    return $this->create("class." . $this->phpPathFixer($classname) . '.php');
  }

  public function getMethodPath($classname, $method) {
    return $this->create($this->phpPathFixer($classname) . ".$method.php");
  }

  public function getConstantPath($className, $constant) {
    $constantName = $this->phpPathFixer($constant);
    return $this->getClassPath() . "#$className.constants.$constantName";
  }

  public function getNamespacePath($ns) {
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
