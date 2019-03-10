<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Adapters;

use Sphp\Html\Component;

/**
 * Implements a Visibility Adapter

 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VisibilityAdapter extends AbstractComponentAdapter {

  /**
   * Sets whether the component is in use or not
   *
   * @param  boolean $hide true if the button is in use, false otherwise
   * @return $this for a fluent interface
   */
  public function setHidden(bool $hide = true) {
    if (!$hide) {
      $this->unhide();
    } else {
      $this->hide();
    }
    return $this;
  }

  /**
   * Hides the component from the document
   *
   * **Note:**
   *
   * The element will not be displayed at all (has no effect on layout). Adds
   * an inline style property `display: none;` to the component.
   *
   * @return $this for a fluent interface
   */
  public function hide() {
    $this->getComponent()->inlineStyles()->setProperty('display', 'none');
    return $this;
  }

  /**
   * Unhides the component (Removes the inline hiding property)
   *
   * **Notes:**
   *
   *  Removes only inline style property `display: hidden;` . The component
   *  might still be defined as hidden in CSS style sheets or by a JavaScript command.
   *
   * @return $this for a fluent interface
   */
  public function unhide() {
    if ($this->getComponent()->inlineStyles()->getProperty('display') === 'none') {
      $this->getComponent()->inlineStyles()->unsetProperty('display');
    }
    return $this;
  }

}
