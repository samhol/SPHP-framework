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
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Iterator extends AbstractContent implements NativeIterator, TraversableContent {

  use TraversableTrait;

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

  public function getHtml(): string {
    return Arrays::recursiveImplode($this->components);
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
  public function next(): void {
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
  public function rewind(): void {
    reset($this->components);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return null !== key($this->components);
  }

}
