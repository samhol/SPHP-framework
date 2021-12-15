<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP;

use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Reflection\MethodReflector;
use Sphp\Html\Navigation\A;
use Sphp\Html\Navigation\Nav;
use Sphp\Reflection\Exceptions\ReflectionException;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Stdlib\Strings;

/**
 * Implements a link factory pointing to an external API documentation about a PHP class, interface or trait method
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MethodLinker extends AbstractClassItemLinker {

  private MethodReflector $ref;
  private ClassUrlGenerator $urlGen;

  /**
   * Constructor
   * 
   * @param  MethodReflector $ref
   * @param  ClassUrlGenerator $urlGen
   * @param  HyperlinkFactory|null $hyperlinkFactory
   */
  public function __construct(MethodReflector $ref, ClassUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkFactory = null) {
    $this->ref = $ref;
    $this->urlGen = $urlGen;
    parent::__construct($this->ref, $this->urlGen, $hyperlinkFactory);
    $this->getHyperlinkFactory()->useCssClass('method');
  }

  public function __destruct() {
    unset($this->ref, $this->urlGen);
    parent::__destruct();
  }

  public function __clone() {
    parent::__clone();
    $this->urlGen = clone $this->urlGen;
  }

  public function getMethodName(): string {
    return $this->ref->getName();
  }

  public function toShortlink(): A {
    return $this->toHyperlink($this->getMethodName() . '()');
  }

  public function getDefaultContent(): string {
    return $this->getShortClassName() . "::{$this->getMethodName()}()";
  }

  public function getDefaultTitle(): string {
    return 'Documentation of the ' . $this->getShortClassName() . '::' . $this->getMethodName() . '() method';
  }

  public function getNavBarTitle(): string {
    $type = Strings::convertCase($this->ref->getModifierNames(), MB_CASE_TITLE);
    return "$type Method";
  }

  public function getUrl(): string {
    return $this->urlGen->getClassMethodUrl($this->getClassName(), $this->getMethodName());
  }

  /**
   * Creates a new linker instance
   * 
   * @param  string $class the name of the class
   * @param  string $method the name of the method
   * @param  ClassUrlGenerator $urlGen
   * @param  HyperlinkFactory|null $hyperlinkFactory
   * @return self new linker instance
   * @throws NonDocumentedFeatureException if execution fails
   */
  public static function create(string $class, string $method, ClassUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkFactory = null): self {
    try {
      $ref = new MethodReflector($class, $method);
      return new self($ref, $urlGen, $hyperlinkFactory);
    } catch (ReflectionException $ex) {
      throw new NonDocumentedFeatureException('Cannot create a method linker', 0, $ex);
    }
  }

}
