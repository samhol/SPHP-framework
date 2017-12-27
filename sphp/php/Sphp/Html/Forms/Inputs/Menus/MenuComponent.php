<?php

/**
 * SelectMenuContentInterface.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\ComponentInterface;

/**
 * Defines select menu's content components (&lt;option|optgroup&gt;).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MenuComponent extends ComponentInterface {
  

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and not clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return InputInterface for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_optgroup_disabled.asp disabled attribute
   */
  public function disable(bool $disabled = true);

  /**
   * Checks whether the option is enabled or not
   * 
   * @param  boolean true if the option is enabled, otherwise false
   * @link   http://www.w3schools.com/tags/att_optgroup_disabled.asp disabled attribute
   */
  public function isEnabled(): bool;
}
