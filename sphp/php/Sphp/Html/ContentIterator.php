<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Iterator;
use Sphp\Stdlib\Arrays;

/**
 * Implements a basic iterator for HTML content
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ContentIterator extends AbstractContent implements Iterator, TraversableContent {

  /**
   * the content
   *
   * @var mixed[]
   */
  private array $content = [];

  /**
   * Constructor
   *
   * @param  iterable $content the content of the iterator
   * @link   https://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct(iterable $content = []) {
    if (!is_array($content)) {
      $content = iterator_to_array($content);
    }
    $this->content = $content;
    $this->rewind();
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->content);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->content = Arrays::copy($this->content);
  }

  public function getHtml(): string {
    return Arrays::recursiveImplode($this->content);
  }

  /**
   * Returns a collection of sub components that match the search
   *
   * @param  callable $rules a lambda function for testing the sub components
   * @return TraversableContent containing matching sub components
   */
  public function getComponentsBy(callable $rules): TraversableContent {
    //echo \Sphp\Tools\ClassUtils::getRealClass($this) . " el:";
    //echo $this->count();
    $result = [];
    foreach ($this as $key => $value) {
      //echo \Sphp\Tools\ClassUtils::getRealClass($value);
      if ($rules($value, $key)) {
        //echo " ok ";
        $result[] = $value;
      }
      if ($value instanceof TraversableContent) {
        foreach ($value->getComponentsBy($rules) as $v) {
          $result[] = $v;
        }
        //echo \Sphp\Tools\ClassUtils::getRealClass($value);
        //echo " loop ";
        //$result = array_merge($result, $value->getComponentsBy($rules));
      }
    }
    return new static($result);
  }

  /**
   * Returns a collection of sub components that are of the given PHP type
   *
   * @param  string|\object $type the name of the searched PHP object type
   * @return TraversableContent containing matching sub components
   */
  public function getComponentsByObjectType($type): TraversableContent {
    $search = function($element) use ($type): bool {
      return $element instanceof $type;
    };
    return $this->getComponentsBy($search);
  }

  /**
   * Serializes to an array
   *
   * @return array the instance as an array
   */
  public function toArray(): array {
    return $this->content;
  }

  /**
   * Count the number of contained items 
   *
   * @return int number of items contained
   * @link   https://www.php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->content);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->content);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next(): void {
    next($this->content);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->content);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind(): void {
    reset($this->content);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return bool current iterator position is valid
   */
  public function valid(): bool {
    return null !== key($this->content);
  }

}
