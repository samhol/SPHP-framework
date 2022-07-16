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
use Sphp\Html\Navigation\A;
use Sphp\Reflection\ClassConstantReflector;
use Sphp\Reflection\Exceptions\ReflectionException;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * Implements a link factory pointing to an external API documentation about a PHP class, interface or trait constant
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
final class ClassConstantLinker extends AbstractClassItemLinker {

  private ClassConstantReflector $ref;
  private ClassUrlGenerator $urlGen;

  /**
   * Constructor
   *  
   * @param ClassConstantReflector $ref
   * @param ClassUrlGenerator $urlGen
   * @param HyperlinkFactory|null $hyperlinkFactory
   */
  public function __construct(ClassConstantReflector $ref, ClassUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkFactory = null) {
    $this->ref = $ref;
    $this->urlGen = $urlGen;
    parent::__construct($this->ref, $this->urlGen, $hyperlinkFactory);
    $this->getHyperlinkFactory()->useCssClass('constant');
    if ($this->ref->isInternal()) {
      $this->getHyperlinkFactory()->useCssClass('php');
    }
  }

  public function __destruct() {
    unset($this->ref, $this->urlGen);
    parent::__destruct();
  }

  public function getConstantName(): string {
    return $this->ref->getName();
  }

  public function getDefaultContent(): string {
    return $this->getShortClassName() . '::' . $this->getConstantName();
  }

  public function getDefaultTitle(): string {
    return 'Documentation of the ' . $this->getShortClassName() . '::' . $this->getConstantName() . ' class constant';
  }

  public function toShortlink(): A {
    return $this->toHyperlink($this->getConstantName());
  }

  public function getUrl(): string {
    return $this->urlGen->getClassConstantUrl($this->getClassName(), $this->getConstantName());
  }

  public function getNavBarTitle(): string {
    $type = mb_convert_case($this->ref->getModifierNames(), MB_CASE_TITLE);
    return "$type Class Constant";
  }

  /**
   * Creates a new linker instance
   * 
   * @param  string $class the name of the class
   * @param  string $constant the name of the class constant
   * @param  ClassUrlGenerator $urlGen
   * @param  HyperlinkFactory|null $hyperlinkFactory
   * @return self new linker instance
   * @throws NonDocumentedFeatureException if execution fails
   */
  public static function create(string $class, string $constant, ClassUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkFactory = null): self {
    try {
      $ref = new ClassConstantReflector($class, $constant);
      return new ClassConstantLinker($ref, $urlGen, $hyperlinkFactory);
    } catch (ReflectionException $ex) {
      throw new NonDocumentedFeatureException('Cannot create a class constant linker', 0, $ex);
    }
  }

}
