<?php

/**
 * ScreenReaderLabelable.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Core;

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
interface ScreenReaderLabelable {

  /**
   * Sets the inner label for screen reader text
   * 
   * @param  ScreenReaderLabel|string $label the screen reader label or its textual content
   * @return self for PHP Method Chaining
   */
  public function setScreenReaderLabel($label);

  /**
   * Returns the inner label for screen reader text
   * 
   * @return ScreenReaderLabel the inner label for screen reader text
   */
  public function getScreeReaderLabel();
}
