<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Stdlib\Strings;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\Attributes\MapAttribute;
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

  private string $tagName;
  private ?AttributeContainer $attrs;

  /**
   * Constructor
   *
   * @param  string $tagName the tag name of the component
   * @param  AttributeContainer|null $attrManager the attribute manager of the component
   * @throws HtmlException if the tag name of the component is not valid
   */
  public function __construct(string $tagName, ?AttributeContainer $attrManager = null) {
    if (!Strings::match($tagName, "/^([a-z]+[1-6]{0,1})$/")) {
      throw new HtmlException("The tag name '$tagName' is not valid");
    }
    $this->tagName = $tagName;
    $this->attrs = $attrManager;
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
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
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

  public function identify(?string $id = null): string {
    return $this->attributes()->id()->identify($id);
  }

  public function cssClasses(): ClassAttribute {
    return $this->attributes()->classes();
  }

  public function css(): MapAttribute {
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
