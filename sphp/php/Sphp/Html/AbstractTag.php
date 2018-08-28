<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Stdlib\Strings;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Abstract Class is the base class for all HTML tag implementations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractTag implements Tag {

  use ContentTrait,
      ComponentTrait;

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

  //private static $c = 0;

  /**
   * Constructor
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
    // self::$c++;
    // echo "tag:" .self::$c."\n";
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

  public function attributes(): HtmlAttributeManager {
    if ($this->attrs === null) {
      $this->attrs = new HtmlAttributeManager();
    }
    return $this->attrs;
  }

  /**
   * Returns the attributes attached as a string
   * 
   * @return string the attributes attached as a string
   */
  protected function attributesToString(): string {
    $output = '';
    if ($this->attrs !== null && $this->attrs->containsAttributes()) {
      $output = " $this->attrs";
    }
    return $output;
  }

}
