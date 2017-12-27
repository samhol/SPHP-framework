<?php

/**
 * FormController.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\Content;

/**
 * Defines a form controller
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-12-27
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface FormController extends Content {

  /**
   * Disables the controller
   * 
   * A disabled form controller is unusable and un-clickable. 
   * Disabled input in a form will not be submitted.
   *
   * @param  boolean $disabled true for disabled, otherwise false
   * @return $this for a fluent interface
   */
  public function disable(bool $disabled = true);

  /**
   * Checks whether the controller is enabled or not
   * 
   * @return boolean true if enabled, otherwise false
   */
  public function isEnabled(): bool;
}
