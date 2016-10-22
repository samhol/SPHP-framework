<?php

/**
 * CloseButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractComponent;

/**
 * Class implements Foundation 6 Close Button in PHP
 * 
 * The close button on its own doesn't close elements, but it can be use with 
 * Toggler, Reveal, Off-canvas, and other plugins that have open and close behaviors.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/close-button.html Foundation 6 Close Button
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CloseButton extends AbstractComponent {

  /**
   * Constructs a new instance
   * 
   * @param string $text the screen reader-only text
   */
  public function __construct($text = 'close') {
    parent::__construct('button');
    $this->attrs()
            ->lock('type', 'button')
            ->demand('data-close');
    $this->cssClasses()->lock('close-button');
    $this->setAccessibilityTextText($text);
  }

  /**
   * Sets the screen reader-only text
   * 
   * @param  string $text the screen reader-only text
   * @return self for PHP Method Chaining
   * @link   https://www.w3.org/TR/WCAG20-TECHS/ARIA14.html aria-label
   */
  public function setAccessibilityTextText($text) {
    $this->attrs()->setAria('label', $text);
    return $this;
  }

  public function contentToString() {
    return '<span aria-hidden="true">&times;</span>';
  }

}
