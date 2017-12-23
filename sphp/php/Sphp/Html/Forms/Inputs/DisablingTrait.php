<?php

/**
 * DisablingTrait.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Description of DisablingTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-12-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait DisablingTrait {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attrs(): HtmlAttributeManager;

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and un-clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return $this for a fluent interface
   */
  public function disable(bool $disabled = true) {
    $this->attrs()->setBoolean('disabled', $disabled);
    return $this;
  }

  /**
   * Checks whether the option is enabled or not
   * 
   * @param  boolean true if the option is enabled, otherwise false
   */
  public function isEnabled(): bool {
    return !$this->attrExists('disabled');
  }

}
