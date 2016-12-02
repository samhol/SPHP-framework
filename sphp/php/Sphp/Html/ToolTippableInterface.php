<?php

/**
 * ToolTippableInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Defines a (visual) content that has a tooltip
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-19
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ToolTippableInterface extends ContentInterface {

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
   * @return string|null the value of the title attribute
   * @link http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function getTitle();
}
