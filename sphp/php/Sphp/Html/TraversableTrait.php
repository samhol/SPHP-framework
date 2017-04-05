<?php

/**
 * TraversableTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Trait implements some {@link TraversableInterface} functionality
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-19
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait TraversableTrait {

  /**
   * Returns a collection of sub components that match the search
   *
   * @param  callable $rules a lambda function for testing the sub components
   * @return TraversableInterface containing matching sub components
   */
  public function getComponentsBy(callable $rules) {
    //echo \Sphp\Tools\ClassUtils::getRealClass($this) . " el:";
    //echo $this->count();
    $result = new Container();
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
   * Returns a collection of sub components that contain the searched attribute
   *
   * @param  string $attrName the name of the searched attribute
   * @return TraversableInterface containing matching sub components
   */
  public function getComponentsByAttrName($attrName) {
    $search = function($element) use ($attrName) {
      if (!($element instanceof ComponentInterface)) {
        return false;
      } else if ($element->attrExists($attrName)) {
        return true;
      } else {
        return false;
      }
    };
    return $this->getComponentsBy($search);
  }

  /**
   * Returns a collection of sub components that are of the given PHP type
   *
   * @param  string|\object $typeName the name of the searched PHP object type
   * @return TraversableInterface containing matching sub components
   */
  public function getComponentsByObjectType($type) {
    $search = function($element) use ($type) {
      $result = false;
      if ($element instanceof $type) {
        $result = true;
      }
      return $result;
    };
    return $this->getComponentsBy($search);
  }

}
