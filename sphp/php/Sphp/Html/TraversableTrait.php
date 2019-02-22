<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

/**
 * Trait implements some {@link TraversableContent} functionality
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
trait TraversableTrait {

  /**
   * Returns a collection of sub components that match the search
   *
   * @param  callable $rules a lambda function for testing the sub components
   * @return TraversableContent containing matching sub components
   */
  public function getComponentsBy(callable $rules): TraversableContent {
    //echo \Sphp\Tools\ClassUtils::getRealClass($this) . " el:";
    //echo $this->count();
    $result = new PlainContainer();
    foreach ($this as $value) {
      //echo \Sphp\Tools\ClassUtils::getRealClass($value);
      if ($rules($value)) {
        //echo " ok ";
        $result[] = $value;
      }
      if ($value instanceof \Traversable) {
        foreach ($value->getComponentsBy($rules) as $v) {
          $result[] = $v;
        }
        //echo \Sphp\Tools\ClassUtils::getRealClass($value);
        //echo " loop ";
        //$result = array_merge($result, $value->getComponentsBy($rules));
      }
    }
    return $result;
  }

  /**
   * Returns a collection of sub components that are of the given PHP type
   *
   * @param  string|\object $type the name of the searched PHP object type
   * @return TraversableContent containing matching sub components
   */
  public function getComponentsByObjectType($type): TraversableContent {
    $search = function($element) use ($type) {
      $result = false;
      if ($element instanceof $type) {
        $result = true;
      }
      return $result;
    };
    return $this->getComponentsBy($search);
  }

  /**
   * Serializes to an array
   *
   * @return array the instance as an array
   */
  public function toArray(): array {
    return iterator_to_array($this);
  }

  /**
   * Count the number of contained items 
   *
   * @return int number of items contained
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->toArray());
  }

}
