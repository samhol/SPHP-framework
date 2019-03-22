<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use IteratorAggregate;
use Sphp\Stdlib\Arrays;
use Traversable;

/**
 * Implements a container for HTML components and other textual content
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PlainContainer extends AbstractContent implements IteratorAggregate, Container, ContentParser {

  use ContentParserTrait,
      TraversableTrait;

  /**
   * content
   *
   * @var mixed[]
   */
  private $components;

  /**
   * Constructor
   *
   * @param  mixed $content added content
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    $this->components = [];
    if ($content !== null) {
      $this->append($content);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->components);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->components = Arrays::copy($this->components);
  }

  public function append($content) {
    $this->components[] = $content;
    return $this;
  }

  public function prepend($content) {
    array_unshift($this->components, $content);
    return $this;
  }

  public function resetContent($content) {
    $this->clear()->append($content);
    return $this;
  }

  /**
   * Checks whether an offset exists
   *
   * @param  mixed $offset an offset to check for
   * @return boolean true on success or false on failure
   */
  public function offsetExists($offset): bool {
    return isset($this->components[$offset]) || array_key_exists($offset, $this->components);
  }

  /**
   * Returns the content element at the specified offset
   *
   * @param  mixed $offset the index with the content element
   * @return mixed content element or null
   */
  public function offsetGet($offset) {
    $result = null;
    if ($this->offsetExists($offset)) {
      $result = $this->components[$offset];
    }
    return $result;
  }

  /**
   * Assigns content to the specified offset
   *
   * @param  mixed $offset the offset to assign the value to
   * @param  mixed $value the value to set
   * @return void
   */
  public function offsetSet($offset, $value) {
    if (is_null($offset)) {
      $this->components[] = $value;
    } else {
      $this->components[$offset] = $value;
    }
  }

  /**
   * Unsets an offset
   *
   * @param  mixed $offset offset to unset
   * @return void
   */
  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      unset($this->components[$offset]);
    }
    return $this;
  }

  public function clear() {
    $this->components = [];
    return $this;
  }

  public function getHtml(): string {
    return Arrays::recursiveImplode($this->components);
  }

  public function exists($value): bool {
    $result = false;
    foreach ($this->components as $component) {
      if ($component === $value || (($component instanceof Container)) && $component->exists($value)) {
        $result = true;
        break;
      }
    }
    return $result;
  }

  /**
   * Creates a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new Iterator($this->components);
  }

}
