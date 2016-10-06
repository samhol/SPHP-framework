<?php

/**
 * VisualComponentTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Trait implements functionality of the {@link VisualComponentInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait VisualComponentTrait {

  use IdentifiableComponentTrait;

  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $title the value of the title attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setTitle($title) {
    $this->attrs()->set('title', $title);
    return $this;
  }

  /**
   * Returns the value of the title attribute
   *
   * @return string|null the value of the title attribute
   * @link http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function getTitle() {
    return $this->attrs()->get('title');
  }

  /**
   * Hides the component from the document
   *
   * **Note:**
   *
   * The element will not be displayed at all (has no effect on layout). Adds
   * an inline style property <var>display: hidden;</var> to the component.
   *
   * @return self for PHP Method Chaining
   */
  public function hide() {
    $this->setStyle('display', 'none');
    return $this;
  }

  /**
   * Unhides the component (Removes the inline hiding property)
   *
   * **Notes:**
   *
   *  Removes only inline style property <var>display: hidden;</var> . The component
   *  might still be defined as hidden in CSS style sheets or by a JavaScript command.
   *
   * @return self for PHP Method Chaining
   */
  public function unhide() {
    $this->removeStyle('display');
    return $this;
  }

}
