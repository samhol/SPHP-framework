<?php

/**
 * VisualComponentInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Interface specifies the basic functionality of any HTML component
 *
 * An instance models an actual HTML component and supports HTML attribute manipulation.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface VisualComponentInterface extends ComponentInterface {


  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $title the value of the title attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setTitle($title);

  /**
   * Returns the value of the title attribute
   *
   * @return self|null the value of the title attribute
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function getTitle() ;

  /**
   * Hides the component from the document
   *
   * **Note:**
   *
   * The element will not be displayed at all (has no effect on layout). Adds
   * an inline style property `display: hidden;` to the component.
   *
   * @return self for PHP Method Chaining
   */
  public function hide();

  /**
   * Unhides the component (Removes the inline hiding property)
   *
   * **Notes:**
   *
   *  Removes only inline style property `display: hidden;`. The component
   *  might still be defined as hidden in CSS style sheets or by a JavaScript command.
   *
   * @return self for PHP Method Chaining
   */
  public function unhide();
}
