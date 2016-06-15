<?php

/**
 * CloseButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\Forms\Buttons\Button as Button;

/**
 * Class implements Foundation 6 Close Button in PHP
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/sites/docs/ Foundation 6
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CloseButton extends Button {

  /**
   * Constructs a new instance
   * 
   * @param string $text the screen reader-only text
   */
  public function __construct($text = "close") {
    parent::__construct("button", '<span aria-hidden="true">&times;</span>');
    $this->attrs()->demand("data-close");
    $this->cssClasses()->lock("close-button");
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
    $this->attrs()->set("aria-label", $text);
    return $this;
  }

}
