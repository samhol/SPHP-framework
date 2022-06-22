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
use Sphp\Reflection\PropertyReflector;
use Sphp\Html\Navigation\A;
use Sphp\Html\Navigation\Nav;
use Sphp\Stdlib\Strings;
use Sphp\Reflection\Exceptions\ReflectionException;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * Implements a link factory pointing to an external API documentation about a PHP class, interface or trait property
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
final class PropertytLinker extends AbstractClassItemLinker {

  private PropertyReflector $ref;
  private ClassUrlGenerator $urlGen;

  /**
   * Constructor
   * 
   * @param PropertyReflector $ref
   * @param ClassUrlGenerator $urlGen
   * @param HyperlinkFactory|null $attributeInjector
   */
  public function __construct(PropertyReflector $ref, ClassUrlGenerator $urlGen, ?HyperlinkFactory $attributeInjector = null) {
    $this->ref = $ref;
    $this->urlGen = $urlGen;
    parent::__construct($this->ref, $this->urlGen, $attributeInjector);
    $this->getHyperlinkFactory()->useCssClass('property');
  }

  public function __destruct() {
    unset($this->ref, $this->urlGen);
    parent::__destruct();
  }

  public function getPropertyName(): string {
    return $this->ref->getName();
  }

  public function toShortlink(): A {
    return $this->toHyperlink('$' . $this->getPropertyName());
  }

  public function getDefaultContent(): string {
    return $this->getShortClassName() . "::$" . $this->getPropertyName();
  }

  public function getDefaultTitle(): string {
    $out = 'Documentation of ';
    $out .= $this->ref->getModifierNames();
    if ($this->ref->isStatic()) {
      $out .= ' static';
    }
    return $out . ' ' . $this->getShortClassName() . '::$' . $this->getPropertyName() . ' property';
  }

  public function getUrl(): string {
    return $this->urlGen->getClassPropertyUrl($this->getClassName(), $this->getPropertyName());
  }

  public function getNavBarTitle(): string {
    $type = Strings::convertCase($this->ref->getModifierNames(), MB_CASE_TITLE);
    return "$type Property";
  }

  /**
   * Creates a new linker instance
   * 
   * @param  string $class the name of the class
   * @param  string $property the name of the class property
   * @param  ClassUrlGenerator $urlGen
   * @param  HyperlinkFactory|null $hyperlinkFactory
   * @return self new linker instance
   * @throws NonDocumentedFeatureException if execution fails
   */
  public static function create(string $class, string $property, ClassUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkFactory = null): self {
    try {
      if (str_starts_with($property, '$')) {
        $property = Strings::replace($property, '$', '');
      }
      $ref = new PropertyReflector($class, $property);
      return new self($ref, $urlGen, $hyperlinkFactory);
    } catch (ReflectionException $ex) {
      throw new NonDocumentedFeatureException('Cannot create a property linker', 0, $ex);
    }
  }

}
