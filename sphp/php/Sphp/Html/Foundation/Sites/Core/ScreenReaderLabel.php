<?php

/**
 * ScreenReaderLabel.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Span;

/**
 * Class implements Foundation 6 Screen reader label for Foundation
 * 
 * As default all of the content of this component is only visible for screen readers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/visibility.html#show-for-screen-readers-only Foundation 6 screen readers
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ScreenReaderLabel extends Span {

  /**
   * Constructs a new instance
   *
   * @param string $content the textual content of the screen reader label
   */
  public function __construct($content = '') {
    parent::__construct($content);
    $this->cssClasses()->lock('show-for-sr');
  }

}
