<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Stdlib\Strings;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\Attributes\PropertyCollectionAttribute;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Exceptions\HtmlException;

/**
 * Abstract Class is the base class for all HTML tag implementations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractTag extends AbstractContent implements Tag {

  /**
   * the tag name of the component
   *
   * @var string
   */
  private $tagName;

  /**
   * attribute container
   *
   * @var AttributeContainer
   */
  private $attrs;

  //private static $c = 0;

  /**
   * Constructor
   *
   * @param  string $tagName the tag name of the component
   * @param  AttributeContainer|null $attrManager the attribute manager of the component
   * @throws HtmlException if the tag name of the component is not valid
   */
  public function __construct(string $tagName, AttributeContainer $attrManager = null) {
    if (!Strings::match($tagName, "/^([a-z]+[1-6]{0,1})$/")) {
      throw new HtmlException("The tag name '$tagName' is malformed");
    }
    $this->tagName = $tagName;
    if ($attrManager !== null) {
      $this->attrs = $attrManager;
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->attrs);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    if ($this->attrs !== null) {
      $this->attrs = clone $this->attrs;
    }
  }

  public function getTagName(): string {
    return $this->tagName;
  }

  public function attributes(): AttributeContainer {
    if ($this->attrs === null) {
      $this->attrs = new AttributeContainer();
    }
    return $this->attrs;
  }

  public function setId(string $id) {
    $this->attributes()->setAttribute('id', $id);
    return $this;
  }

  public function identify(bool $forceNewValue = false): string {
    return $this->attributes()->id()->identify($forceNewValue);
  }

  public function cssClasses(): ClassAttribute {
    return $this->attributes()->classes();
  }

  public function css(): PropertyCollectionAttribute {
    return $this->attributes()->styles();
  }

  public function setAttribute(string $name, $value = true) {
    $this->attributes()->setAttribute($name, $value);
    return $this;
  }

  public function removeAttribute(string $name) {
    $this->attributes()->remove($name);
    return $this;
  }

  public function getAttribute(string $name) {
    return $this->attributes()->getValue($name);
  }

  public function attributeExists(string $name): bool {
    return $this->attributes()->isVisible($name);
  }

  protected function attributesToString(): string {
    $output = '';
    if ($this->attrs !== null && $this->attrs->count() > 0) {
      $output = " $this->attrs";
    }
    return $output;
  }

  public function addCssClass(string ...$cssClasses) {
    $this->cssClasses()->add(...$cssClasses);
    return $this;
  }

  public function removeCssClass(string ...$cssClasses) {
    $this->cssClasses()->remove(...$cssClasses);
    return $this;
  }

  public function hasCssClass(string ...$cssClasses): bool {
    return $this->cssClasses()->contains(...$cssClasses);
  }

}
