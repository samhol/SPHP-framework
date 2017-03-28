<?php

/**
 * Iterator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Iterator as NativeIterator;
use Traversable;
use Sphp\Stdlib\Arrays;

/**
 * Implements a basic iterator for HTML content
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-09
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Iterator implements NativeIterator, ContentInterface, TraversableInterface {

  use ContentTrait, TraversableTrait;

  /**
   * container's content
   *
   * @var mixed[]
   */
  private $components = [];

  /**
   * Constructs a new instance
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
   * @return int number of elements in the html component
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count() {
    return count($this->components);
  }

  public function getHtml() {
    return Arrays::implode($this->components);
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
   */
  public function rewind() {
    reset($this->components);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid() {
    return false !== current($this->components);
  }

}
