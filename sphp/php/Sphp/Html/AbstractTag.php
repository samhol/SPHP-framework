<?php

/**
 * AbstractTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeManager;
use Sphp\Core\Types\Strings;
use InvalidArgumentException;

/**
 * Abstract Class is the base class for all HTML tag implementations
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractTag implements TagInterface {

  use IdentifiableComponentTrait;

  /**
   * the tagname of the component
   *
   * @var string
   */
  private $tagName;

  /**
   * attribute container
   *
   * @var AttributeManager
   */
  private $attrs;

  /**
   * Constructs a new instance
   *
   * @param  string $tagName the tag name of the component
   * @param  AttributeManager|null $attrManager the attribute manager of the component
   * @throws InvalidArgumentException if the tagname of the component is not valid
   */
  public function __construct($tagName, AttributeManager $attrManager = null) {
    $this->setTagName($tagName)
            ->setAttributeManager($attrManager);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->attrs, $this->tagName);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->attrs = clone $this->attrs;
  }

  /**
   * Sets the tag name of the component
   *
   * @param  string $tagName the tag name of the component
   * @return self for PHP Method Chaining
   * @throws InvalidArgumentException if the `$tagName` is not valid
   */
  private function setTagName($tagName) {
    if (!Strings::match($tagName, "/^([a-z]+[1-6]{0,1})$/")) {
      throw new InvalidArgumentException("'$tagName' is malformed");
    }
    $this->tagName = $tagName;
    return $this;
  }

  public function getTagName() {
    return $this->tagName;
  }

  /**
   * Sets the attribute manager attached to the component
   *
   * @param  AttributeManager $attrManager the attribute manager to set
   * @return self for PHP Method Chaining
   */
  private function setAttributeManager(AttributeManager $attrManager = null) {
    if ($attrManager === null) {
      $this->attrs = new AttributeManager();
    } else {
      $this->attrs = $attrManager;
    }
    return $this;
  }

  public function attrs() {
    return $this->attrs;
  }

}
