<?php

/**
 * PHPManualUrlGenerator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * URL string generator pointing to online PHP Manual
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PHPManualUrlGenerator extends UrlGenerator implements ApiUrlGeneratorInterface {

  /**
   * Constructs a new instance
   * 
   * @param string $lang the language of the PHP manual
   */
  public function __construct($lang = 'en') {
    parent::__construct('https://secure.php.net/manual/en/');
    if ($lang !== 'en') {
      $this->setLanguage($lang);
    }
  }

  /**
   * Fixes the relative path to the PHP documentation resource
   * 
   * @param  string $path the relative path to the PHP documentation resource
   * @return string the fixed relative path to the PHP documentation resource
   */
  protected function phpPathFixer($path) {
    return strtolower(str_replace(['_', '\\'], ['-', '.'], $path));
  }

  public function getClassUrl($class) {
    return $this->create("class." . $this->phpPathFixer($class) . '.php');
  }

  public function getClassMethodUrl($class, $method) {
    return $this->create($this->phpPathFixer($class) . ".$method.php");
  }

  public function getClassConstantUrl($class, $constant) {
    $className = $this->phpPathFixer($class);
    $constantName = $this->phpPathFixer($constant);
    return $this->getClassUrl($class) . "#$className.constants.$constantName";
  }

  public function getNamespaceUrl($namespace) {
    $path = str_replace('\\', '.', $namespace);
    return $this->create("namespace-$path.html");
  }

  public function getFunctionUrl($function) {
    return $this->create("function." . $this->phpPathFixer($function));
  }
  
  public function getConstantUrl($constant) {
    return $this->create('reserved.constants.php#constant.' . $this->phpPathFixer($constant));
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
