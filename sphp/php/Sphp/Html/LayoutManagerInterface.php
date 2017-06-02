<?php

/**
 * LayoutManagerInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html;

/**
 * Defines a layout manager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface LayoutManagerInterface {

  /**
   * Sets the managed component
   * 
   * @param ComponentInterface $component
   * @return self for a fluent interface
   */
  public function manage(ComponentInterface $component);

  /**
   * Sets the layout
   *
   * @param  mixed|mixed[] $layouts layout parameters
   * @return self for a fluent interface
   */
  public function setLayouts($layouts);

  /**
   * Unsets the layout
   *
   * @return self for a fluent interface
   */
  public function unsetLayouts();
}
