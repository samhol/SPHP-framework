<?php

/**
 * AbstractTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeChanger as AttributeChanger;
use Sphp\Html\Attributes\AttributeChangeObserver as AttributeChangeObserver;
use Sphp\Html\Attributes\AttributeManager as AttributeManager;
use Sphp\Core\Types\Strings as Strings;
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
abstract class AbstractTag implements ComponentInterface, AttributeChanger {

  use ComponentTrait;

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
   * collection of individual id change observer objects
   *
   * @var \SplObjectStorage
   */
  private $observers;

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
    unset($this->attrs, $this->tagName, $this->observers);
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
      throw new InvalidArgumentException("$tagName; HTML tagname contains only lowercase alphabets");
    }
    $this->tagName = $tagName;
    return $this;
  }

  /**
   * Returns the tag name of the component
   *
   * @return string the tag name of the component
   */
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
    if (!($attrManager instanceof AttributeManager)) {
      $this->attrs = new AttributeManager();
    } else {
      $this->attrs = $attrManager;
    }
    $observer = function (AttributeChanger $obj, $attrName) {
      if ($obj === $this->attrs) {
        $this->notifyAttributeChange($attrName);
      }
      $this->attrs->attachAttributeChangeObserver($observer);
    };
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function attrs() {
    return $this->attrs;
  }

  /**
   * {@inheritdoc}
   */
  public function attachAttributeChangeObserver($observer) {
    if ($this->observers === null) {
      $this->observers = new \SplObjectStorage();
    }
    $this->observers->attach($observer);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function detachAttributeChangeObserver($observer) {
    $this->observers->detach($observer);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function notifyAttributeChange($attrName) {
    if ($this->observers !== null) {
      foreach ($this->observers as $obs) {
        if ($obs instanceof AttributeChangeObserver) {
          $obs->attributeChanged($this, $attrName);
        } else {
          $obs($this, $attrName);
        }
      }
    }
    return $this;
  }

}
