<?php

/**
 * DataOptions.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;


/**
 * Interface DataOptions
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-30
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface FoundationComponentInterface extends \Sphp\Html\ComponentInterface {
  
  
  /**
   * Returns the attribute manager attached to the component
   * 
   * @return FoundationAttributeManager the attribute manager
   */
  public function attrs();

  /**
   * Returns the 'data-option' attribute object
   *
   * @return PropertyAttribute the 'data-option' attribute object
   */
  public function dataOptions();
}
