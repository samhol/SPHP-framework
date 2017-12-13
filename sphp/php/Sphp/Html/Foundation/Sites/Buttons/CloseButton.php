<?php

/**
 * CloseButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractComponent;

/**
 * Implements Close Button
 * 
 * The close button on its own doesn't close elements, but it can be use with 
 * Toggler, Reveal, Off-canvas, and other plugins that have open and close behaviors.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/close-button.html Foundation 6 Close Button
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CloseButton extends AbstractComponent {

  /**
   * Constructs a new instance
   * 
   * @param string $ariaLabel the screen reader-only text
   * @link  https://www.w3.org/TR/WCAG20-TECHS/ARIA14.html aria-label
   */
  public function __construct(string $ariaLabel = 'close') {
    parent::__construct('button');
    $this->attrs()
            ->protect('type', 'button')
            ->demand('data-close');
    $this->cssClasses()->protect('close-button');
    $this->setAriaLabel($ariaLabel);
  }

  /**
   * Sets the screen reader-only text
   * 
   * @param  string $label the screen reader-only text
   * @return $this for a fluent interface
   * @link   https://www.w3.org/TR/WCAG20-TECHS/ARIA14.html aria-label
   */
  public function setAriaLabel(string $label = null) {
    $this->attrs()->setAria('label', $label);
    return $this;
  }

  public function contentToString(): string {
    return '<span aria-hidden="true">&times;</span>';
  }

}
