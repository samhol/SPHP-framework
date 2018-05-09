<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators\PHPManual;

use Sphp\Html\Apps\HyperlinkGenerators\UrlGenerator;
use Sphp\Html\Apps\HyperlinkGenerators\ApiUrlGeneratorInterface;

/**
 * URL string generator pointing to online PHP Manual
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PHPManualUrlGenerator extends UrlGenerator implements ApiUrlGeneratorInterface {

  /**
   * Constructor
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
    return $this->createUrl("class." . $this->phpPathFixer($class) . '.php');
  }

  public function getClassMethodUrl(string $class, string $method): string {
    return $this->createUrl($this->phpPathFixer($class) . ".$method.php");
  }

  public function getClassConstantUrl(string $class, string $constant): string {
    $className = $this->phpPathFixer($class);
    $constantName = $this->phpPathFixer($constant);
    return $this->getClassUrl($class) . "#$className.constants.$constantName";
  }

  public function getNamespaceUrl(string $namespace): string {
    $path = str_replace('\\', '.', $namespace);
    return $this->createUrl("namespace-$path.html");
  }

  public function getFunctionUrl(string $function): string {
    return $this->createUrl("function." . $this->phpPathFixer($function));
  }

  public function getConstantUrl(string $constant): string {
    return $this->createUrl('reserved.constants.php#constant.' . $this->phpPathFixer($constant));
  }

  /**
   * Sets the language of the PHP documentation
   * 
   * @param  string $lang two letter language code 
   * @return $this for a fluent interface
   */
  public function setLanguage(string $lang) {
    $url = preg_replace('~[a-z]{2}\/$~', "$lang/", $this->getRoot());
    $this->setRoot($url);
    return $this;
  }

}
