<?php

/**
 * AbstractTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Stdlib\Strings;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Abstract Class is the base class for all HTML tag implementations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractTag implements TagInterface {

  use IdentifiableComponentTrait;

  /**
   * the tag name of the component
   *
   * @var string
   */
  private $tagName;

  /**
   * attribute container
   *
   * @var HtmlAttributeManager
   */
  private $attrs;

  /**
   * Constructs a new instance
   *
   * @param  string $tagName the tag name of the component
   * @param  HtmlAttributeManager|null $attrManager the attribute manager of the component
   * @throws InvalidArgumentException if the tag name of the component is not valid
   */
  public function __construct(string $tagName, HtmlAttributeManager $attrManager = null) {
    if (!Strings::match($tagName, "/^([a-z]+[1-6]{0,1})$/")) {
      throw new InvalidArgumentException("The tag name '$tagName' is malformed");
    }
    $this->tagName = $tagName;
    if ($attrManager !== null) {
      $this->attrs = $attrManager;
    }
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
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

  //private static $count = 0;

  public function attrs(): HtmlAttributeManager {
    if ($this->attrs === null) {
      $this->attrs = new HtmlAttributeManager();
      //self::$count += 1;
      //if ((self::$count % 10) === 0) {
     // echo "\nMan: " . self::$count;
      //}
    }
    return $this->attrs;
  }

}
