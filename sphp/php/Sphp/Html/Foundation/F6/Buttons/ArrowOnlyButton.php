<?php

/**
 * ArrowOnlyButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\Span as Span;
use Sphp\Html\Foundation\F6\Foundation as Foundation;

/**
 * Class implements Foundation 6 Close Button in PHP
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://zurb.com/playground/foundation-icon-fonts-3 Foundation Icon Fonts 3
 * @link    http://foundation.zurb.com/sites/docs/button-group.html#split-buttons Foundation 6 Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ArrowOnlyButton extends AbstractButton {

  /**
   * Constructs a new instance
   *
   * @param string $icon Foundation Icon Font name
   * @param string $screenReaderText the screen reader-only text
   */
  public function __construct($screenReaderText = "") {
    parent::__construct("button");
    $this->cssClasses()->lock("dropdown arrow-only");
    $screenReaderBtn = new Span($screenReaderText);
    $screenReaderBtn->cssClasses()->lock("show-for-sr");
    $this->content()->set("show-for-sr", $screenReaderBtn);
  }

}
