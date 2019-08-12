<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use Sphp\Html\Navigation\A;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumb;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumbs;

/**
 * Hyperlink generator pointing to an online PHP API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BasicPhpApiLinker extends AbstractLinker {

  /**
   * @var string
   */
  private $ns;

  /**
   * @var string
   */
  private $classLinkerType;

  /**
   * Constructor
   *
   * @param  ApiUrlGenerator $urlGen
   * @param  string $classLinkerType
   * @param  string $namespace
   * @throws SphpException
   */
  public function __construct(ApiUrlGenerator $urlGen, string $classLinkerType = BasicClassLinker::class, string $namespace = null) {
    $this->ns = $namespace;
    if (!is_a($classLinkerType, ClassLinker::class, true)) {
      throw new SphpException("$classLinkerType in not a subtype of " . ClassLinker::class);
    }
    $this->classLinkerType = $classLinkerType;
    parent::__construct($urlGen);
  }

  /**
   * Returns linker properties or hyperlinks
   * 
   * @param  string $name
   * @return A|Sami
   * @throws SphpException
   */
  public function __get(string $name) {
    $test = $this->ns . "\\$name";
    //echo "\npath: $test";
    if (is_callable($test)) {
      return $this->functionLink($test);
    } else if (class_exists($test) || interface_exists($test) || trait_exists($test)) {
      return $this->classLinker($test);
    } else if (defined($test)) {
      return $this->constantLink($test);
    } else {
      $chain = new static($this->urls(), $this->ns . "\\$name");
      $chain->useAttributes($this->getAttributes());
      return $chain;
    }
  }

  /**
   * Returns a new class linker instance for the given class
   * 
   * @param  string $class class name or object
   * @return ClassLinker new instance
   * @throws InvalidArgumentException if the class name does not exist
   */
  public function classLinker(string $class): ClassLinker {
    $classLinkerType = $this->classLinkerType;
    if (class_exists($class) || interface_exists($class) || trait_exists($class)) {
      $classLinker = new $classLinkerType($class, $this->urls());
      $classLinker->useAttributes($this->getAttributes());
    } else {
      throw new InvalidArgumentException("Class '$class' does not exist");
    }
    return $classLinker;
  }

  protected function createHyperlink(string $url, string $content, string $title = null): A {
    $a = new A($url, $content);
    if ($title !== null) {
      $a->attributes()->title = $title;
    }
    $this->insertAttributesTo($a);
    return $a;
  }

  /**
   * Returns a hyperlink object pointing to an API page describing PHP function 
   *
   * @param  string $function the name of the function
   * @param  string $linkText optional link text
   * @return A hyperlink object pointing to the documentation
   */
  public function functionLink(string $function, string $linkText = null): A {
    if ($linkText === null) {
      $linkText = $function;
    }
    $path = $this->urls()->getFunctionUrl($function);
    return $this->createHyperlink($path, $function, "function $function()")
                    ->addCssClass('function');
  }

  /**
   * Returns a hyperlink object pointing to an API page describing PHP constant 
   * 
   * @param  string $constant the name of the constant
   * @param  string $linkText optional link text
   * @return A hyperlink object pointing to the documentation
   */
  public function constantLink(string $constant, string $linkText = null): A {
    if ($linkText === null) {
      $linkText = $constant;
    }
    $path = $this->urls()->getConstantUrl($constant);
    return $this->createHyperlink($path, $linkText, "$constant constant")
                    ->addCssClass('constant');
  }

  /**
   * Returns a hyperlink object pointing to an API namespace page
   *
   * @param  string $namespace namespace name
   * @param  boolean $fullName true if the full namespace name is visible, false otherwise
   * @return A hyperlink object pointing to an API namespace page1
   */
  public function namespaceLink(string $namespace, bool $fullName = true): A {
    if ($fullName) {
      $name = $namespace;
    } else {
      $nsArr = explode('\\', $namespace);
      $name = array_pop($nsArr);
    }
    $url = $this->urls()->getNamespaceUrl($namespace);
    return $this->createHyperlink($url, $name, "The $namespace namespace")->addCssClass('namespace');
  }

  /**
   * Returns a BreadCrumbs component showing the trail of nested namespaces
   * 
   * @param  string $namespace namespace name
   * @return BreadCrumbs breadcrumb showing the trail of nested namespaces
   */
  public function namespaceBreadGrumbs(string $namespace): BreadCrumbs {
    $namespaceArray = explode('\\', $namespace);
    $breadGrumbs = (new BreadCrumbs())->addCssClass('api', 'sphp', 'namespace');
    $currentNamespaceArray = [];
    foreach ($namespaceArray as $name) {
      $currentNamespaceArray[] = $name;
      $path = implode("/", $currentNamespaceArray);
      $root = implode("\\", $currentNamespaceArray);
      $breadCrumb = new BreadCrumb($this->urls()->createUrl("$path.html"), $name);
      $this->insertAttributesTo($breadCrumb);
      //(new QtipAdapter($breadCrumb))->setQtip("$root Namespace")->setQtipPosition('bottom center', 'top center');
      $breadCrumb->getHyperlink()->setAttribute('title', "$root Namespace");
      $breadGrumbs->append($breadCrumb);
    }
    return $breadGrumbs;
  }

}
