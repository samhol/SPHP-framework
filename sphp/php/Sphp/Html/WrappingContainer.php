<?php

/**
 * WrappingContainer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Class defines common features for wrapping HTML container like aa list or a table etc...
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-04-03
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class WrappingContainer extends Container {

  /**
   * the wrapper function
   *
   * @var callable
   */
  private $wrapper;

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * Method applies first the inner callback given to the `$content` 
   * and then appends the result to the container
   * 
   * @param  callable $callback the wrapper function
   * @param  mixed|null $content optional content of the component
   */
  public function __construct(callable $callback = null, $content = null) {
    parent::__construct();
    $this->setWrapper($callback);
    if ($content !== null) {
      $this->append($content);
    }
  }

  /**
   * Sets the wrapper function
   * 
   * @return callable the wrapper function
   */
  private function setWrapper(callable $wrapper = null) {
    $this->wrapper = $wrapper;
    return $this;
  }

  /**
   * Returns the wrapper function
   * 
   * @return callable|null the inner wrapper function or null if none set
   */
  public function getWrapper() {
    return $this->wrapper;
  }

  /**
   * Returns the input as a wrapped output
   * 
   * @param  mixed $content content to wrap
   * @return mixed wrapped input
   */
  public function wrap($content) {
    if (is_callable($this->wrapper)) {
      $wrapper = $this->wrapper;
      $content = $wrapper($content);
    }
    return $content;
  }

  /**
   * Appends content to the component
   *
   * **Notes:**
   *
   * Method applies first the inner callback given in constructor to the `$content` 
   * and then appends the result to the container
   *
   * @param  mixed $content added content
   * @return self for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($content) {
    parent::append($this->wrap($content));
    return $this;
  }

  /**
   * Prepends elements to the html component
   *
   * **Notes:**
   *
   * Method applies first the inner callback given in constructor to the `$content` 
   * and then prepends the result to the container
   *
   * @param  mixed $content added content
   * @return self for a fluent interface
   */
  public function prepend($content) {
    parent::prepend($this->wrap($content));
    return $this;
  }

  /**
   * Assigns content to the specified offset
   * 
   * **Notes:**
   *
   * Method applies first the inner callback given in constructor to the `$content` 
   * and then sets the result to the container to the specified offset
   *
   * @param mixed $offset the offset to assign the value to
   * @param mixed $value the value to set
   */
  public function offsetSet($offset, $value) {
    parent::offsetSet($offset, $this->wrap($value));
  }

}
