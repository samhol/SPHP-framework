<?php

/**
 * HtmlContainer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Data\SphpArrayObject as SphpArrayObject;
use Sphp\Data\ArrayAccessExtensionTrait as ArrayAccessExtensionTrait;
use Sphp\Core\Types\Arrays as Arrays;

/**
 * Clacc implements a container for HTML components and other textual content
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-09
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Container implements ContainerInterface {

  use ContentTrait,
      ArrayAccessExtensionTrait,
      TraversableTrait;

  /**
   * container's content
   *
   * @var SphpArrayObject
   */
  private $components;

  /**
   * Constructs a new instance
   *
   * @param  mixed $content added content
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    $this->components = new SphpArrayObject();
    if ($content !== null) {
      $this->append($content);
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
    $this->components = clone $this->components;
  }

  /**
   * Appends content to the container
   *
   * @param  mixed $content added content
   * @return self for PHP Method Chaining
   */
  public function append($content) {
    $this->components->append($content);
    return $this;
  }

  /**
   * Prepends elements to the container
   *
   * **Note:** the numeric keys of the content will be renumbered starting from zero
   *
   * @param  mixed $content added content
   * @return self for PHP Method Chaining
   */
  public function prepend($content) {
    $this->components->prepend($content);
    return $this;
  }

  /**
   * Count the number of inserted elements in the container
   *
   * @return int number of elements in the html component
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count() {
    return $this->components->count();
  }

  /**
   * Create a new iterator to iterate through inserted elements in the html component
   *
   * @return \ArrayIterator iterator
   */
  public function getIterator() {
    return $this->components->getIterator();
  }

    /**
   * Checks whether an offset exists
   *
   * @param  mixed $offset an offset to check for
   * @return boolean true on success or false on failure
   */
  public function offsetExists($offset) {
    return $this->components->offsetExists($offset);
  }

  /**
   * Returns the content element at the specified offset
   *
   * @param  mixed $offset the index with the content element
   * @return mixed content element or null
   */
  public function offsetGet($offset) {
    return $this->components->offsetGet($offset);
  }

  /**
   * Assigns content to the specified offset
   *
   * @param  mixed $offset the offset to assign the value to
   * @param  mixed $value the value to set
   * @return self for PHP Method Chaining
   */
  public function offsetSet($offset, $value) {
    $this->components->offsetSet($offset, $value);
    return $this;
  }

  /**
   * Unsets an offset
   *
   * @param  mixed $offset offset to unset
   * @return self for PHP Method Chaining
   */
  public function offsetUnset($offset) {
    $this->components->offsetUnset($offset);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return $this->components->toArray();
  }

  /**
   * Replaces the content of the component
   *
   * @param  mixed $content new tag content
   * @return self for PHP Method Chaining
   */
  public function replaceContent($content) {
    return $this->clear()->append($content);
  }

  /**
   * Clears the content of the component
   *
   * @return self for PHP Method Chaining
   */
  public function clear() {
    $this->components->clear();
    return $this;
  }

  /**
   * Returns the component as HTML markup string
   *
   * @return string HTML markup of the component
   * @throws \Exception if the html parsing fails
   */
  public function getHtml() {
    return Arrays::implode($this->components->getArrayCopy());
  }

  /**
   * Returns a {@link HtmlContainer} containing sub components that
   *  match the search
   *
   * @param \Closure $rules a lambda function for testing the sub components
   * @return Container containing matching sub components
   
  public function getComponentsBy(\Closure $rules) {
    //echo \Sphp\Tools\ClassUtils::getRealClass($this) . " el:";
    //echo $this->count();
    $result = new Container();
    foreach ($this as $value) {
      //echo \Sphp\Tools\ClassUtils::getRealClass($value);
      if ($rules($value)) {
        //echo " ok ";
        $result[] = $value;
      }
      if ($value instanceof ContainerInterface) {
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
   * Returns a {@link HtmlContainer} containing sub components that
   *  contain the searched attribute
   *
   * @param  string $attrName the name of the searched attribute
   * @return Container containing matching sub components

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
   * Returns a {@link HtmlContainer} containing sub components
   *  that are of the given PHP type
   *
   * @param  string|\object $type the name of the searched PHP object type
   * @return Container containing matching sub components
   
  public function getComponentsByObjectType($type) {
    $search = function($element) use ($type) {
      $result = false;
      if ($element instanceof $type) {
        $result = true;
      }
      return $result;
    };
    return $this->getComponentsBy($search);
  }*/

}
