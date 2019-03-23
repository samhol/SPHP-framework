<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\Content;

/**
 * Defines a form controller
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface FormController extends Content {

  /**
   * Disables the controller
   * 
   * A disabled form controller is unusable and un-clickable. 
   * Disabled input in a form will not be submitted.
   *
   * @param  bool $disabled true for disabled, otherwise false
   * @return $this for a fluent interface
   */
  public function disable(bool $disabled = true);

  /**
   * Checks whether the controller is enabled or not
   * 
   * @return bool true if enabled, otherwise false
   */
  public function isEnabled(): bool;
}
