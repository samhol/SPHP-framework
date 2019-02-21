<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Controllers;

use Sphp\Html\AbstractComponent;

/**
 * Implements a Foundation framework based Close Button
 * 
 * The close button on its own doesn't close elements, but it can be use with 
 * Toggler, Reveal, Off-canvas, and other plugins that have open and close behaviors.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/close-button.html Foundation 6 Close Button
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CloseButton extends AbstractComponent {

  /**
   * Constructor
   * 
   * @param string $ariaLabel the screen reader-only text
   * @link  https://www.w3.org/TR/WCAG20-TECHS/ARIA14.html aria-label
   */
  public function __construct(string $ariaLabel = 'close') {
    parent::__construct('button');
    $this->attributes()
            // ->protect('type', 'button')
            ->demand('data-close');
    $this->cssClasses()->protectValue('close-button');
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
    $this->attributes()->setAria('label', $label);
    return $this;
  }

  public function contentToString(): string {
    return '<span aria-hidden="true">&times;</span>';
  }

}
