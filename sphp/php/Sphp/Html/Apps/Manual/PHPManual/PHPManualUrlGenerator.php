<?php

/**
 * PHPManualUrlGenerator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual\PHPManual;

use Sphp\Html\Apps\Manual\UrlGenerator;
use Sphp\Html\Apps\Manual\ApiUrlGeneratorInterface;

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
  public function __construct(string $lang = 'en') {
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
  protected function phpPathFixer(string $path): string {
    return strtolower(str_replace(['_', '\\'], ['-', '.'], $path));
  }

  public function getClassUrl(string $class): string {
    return $this->create("class." . $this->phpPathFixer($class) . '.php');
  }

  public function getClassMethodUrl(string $class, string $method): string {
    return $this->create($this->phpPathFixer($class) . ".$method.php");
  }

  public function getClassConstantUrl(string $class, string $constant): string {
    $className = $this->phpPathFixer($class);
    $constantName = $this->phpPathFixer($constant);
    return $this->getClassUrl($class) . "#$className.constants.$constantName";
  }

  public function getNamespaceUrl(string $namespace): string {
    $path = str_replace('\\', '.', $namespace);
    return $this->create("namespace-$path.html");
  }

  public function getFunctionUrl(string $function): string {
    return $this->create("function." . $this->phpPathFixer($function));
  }

  public function getConstantUrl(string $constant): string {
    return $this->create('reserved.constants.php#constant.' . $this->phpPathFixer($constant));
  }

  /**
   * Sets the language of the PHP documentation
   * 
   * @param  string $lang two letter language code 
   * @return self for a fluent interface
   */
  public function setLanguage(string $lang) {
    $url = preg_replace('~[a-z]{2}\/$~', "$lang/", $this->getRoot());
    $this->setRoot($url);
    return $this;
  }

}
