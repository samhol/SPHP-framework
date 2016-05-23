<?php

/**
 * HtmlList.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Closure;

/**
 * Class defines common features for wrapping HTML container like aa list or a table etc...
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-04-03
 * @version 2.0.1
 * @link http://www.w3schools.com/html/html_lists.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class WrappingContainer extends Container {

  /**
   * the wrapper function
   *
   * @var Closure
   */
  private $wrapper;

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   *  1. Any `mixed $content` not implementing {@link LiInterface} is wrapped 
   *     within {@link Li} component
   *  2. All items of an array are treated according to note (1)
   * 
   * @param  Closure $wrapper the wrapper function
   * @param  mixed|null $content optional content of the component
   */
  public function __construct(Closure $wrapper = null, $content = null) {
    parent::__construct();
    if ($wrapper === null) {
      $wrapper = function ($c) {
        return $c;
      };
    }
    $this->setWrapper($wrapper);
    if (isset($content)) {
      $this->append($content);
    }
  }

  /**
   * Sets the wrapper function
   * 
   * @param  Closure $wrapper the wrapper function
   * @return self for PHP Method Chaining
   */
  public function setWrapper(\Closure $wrapper) {
    $this->wrapper = $wrapper;
    return $this;
  }

  /**
   * Appends content to the component
   *
   * **Notes:**
   *
   * 1. Any `mixed $content` not implementing {@link LiInterface} is wrapped 
   *    within {@link Li} component
   *
   * @param  mixed $content added content
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($content) {
    $wrapper = $this->wrapper;
    parent::append($wrapper($content));
    return $this;
  }

  /**
   * Prepends elements to the html component
   *
   * **Notes:**
   *
   * 1. Any `mixed $content` not implementing {@link LiInterface} is wrapped 
   *    within {@link Li} component
   *
   * @param  mixed $content added content
   * @return self for PHP Method Chaining
   */
  public function prepend($content) {
    $wrapper = $this->wrapper;
    parent::prepend($wrapper($content));
    return $this;
  }

  /**
   * Assigns content to the specified offset
   * 
   * **Notes:**
   *
   * 1. Any `mixed $content` not implementing {@link LiInterface} is wrapped 
   *    within {@link Li} component
   *
   * @param mixed $offset the offset to assign the value to
   * @param mixed $value the value to set
   */
  public function offsetSet($offset, $value) {
    $wrapper = $this->wrapper;
    parent::offsetSet($offset, $wrapper($value));
  }

}
