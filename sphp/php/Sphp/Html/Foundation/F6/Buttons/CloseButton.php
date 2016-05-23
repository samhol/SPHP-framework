<?php

/**
 * CloseButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

/**
 * Class implements Foundation 6 Close Button in PHP
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @version 1.0.0
 * @link    http://foundation.zurb.com/sites/docs/button-group.html#split-buttons Foundation 6 Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CloseButton extends IconButton {

  /**
   * Constructs a new instance
   *
   * @param string $text the screen reader-only text
   */
  public function __construct($text = "close") {
    parent::__construct("fi-x", $text);
    $this->attrs()->demand("data-close");
    $this->cssClasses()->lock("close-button transparent");
  }

}
