<?php

/**
 * StyleAttribute.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

/**
 * Class StyleAttribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-15
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class StyleAttribute extends PropertyAttribute {
  
  /**
   * 
   */
  public function __construct() {
    parent::__construct('style');
  }
}
