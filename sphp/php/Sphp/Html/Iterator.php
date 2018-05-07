<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Iterator as NativeIterator;
use Traversable;
use Sphp\Stdlib\Arrays;

/**
 * Implements a basic iterator for HTML content
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Iterator implements NativeIterator, Content, TraversableContent {

  use ContentTrait,
      TraversableTrait;

  /**
   * the content
   *
   * @var mixed[]
   */
  private $components = [];

  /**
   * Constructor
   *
   * @param  mixed $content the content of the iterator
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content) {
    if ($content instanceof Traversable || is_array($content)) {
      foreach ($content as $key => $value) {
        $this->components[$key] = $value;
      }
    } else {
      $this->components[] = $content;
    }
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
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

  /**
   * Count the number of inserted elements in the container
   *
   * @return int number of elements in the HTML component
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->components);
  }

  public function getHtml(): string {
    $output = '';
    foreach ($this->components as $value) {
      if (is_scalar($value) || $value === null) {
        $output .= $value;
      } else if (is_object($value)) {
        if (method_exists($value, '__toString')) {
          $output .= $value;
        } else if ($value instanceof \Traversable) {
          $arr = iterator_to_array($value);
          $output .= Arrays::implode($arr);
        } else {
          throw new InvalidArgumentException('Object has no string representation');
        }
      } else if (is_array($value)) {
        $output .= Arrays::implode($value);
      } else {
        throw new InvalidArgumentException('value has no string representation');
      }
    }
    return $output;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->components);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->components);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->components);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->components);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->components);
  }

}
