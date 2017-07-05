<?php

/**
 * VisibilityChanger.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Core;

/**
 * Defines Visibility Controls for HTML content
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-29
 * @link    http://foundation.zurb.com/ Foundation 
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface VisibilityChanger {

  /**
   * Sets the component visible for all screen sizes
   * 
   * @return self for a fluent interface
   */
  public function showForAllScreenSizes();

  /**
   * Hides the component for the given screen sizes only
   * 
   * Valid flags for `$size` parameter:
   * 
   * * `"small"`: screen widths 0px - 640px
   * * `"medium"`: screen widths 641px - 1024px
   * * `"large"`: screen widths 1025px - 1440px)
   * * `"x-large"`: screen widths 1441px - 1920px
   * * `"xx-large"`: all screen widths from 1921px...
   * 
   * @precondition `$screen` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenType the targeted screensize flags as a bitmask
   * @return self for a fluent interface
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function hideOnlyFromSize(string $screenType);

  /**
   * Shows the component for the given screen sizes only
   * 
   * Valid flags for `$size` parameter:
   * 
   * * `"small"`: screen widths 0px - 640px
   * * `"medium"`: screen widths 641px - 1024px
   * * `"large"`: screen widths 1025px - 1440px)
   * * `"x-large"`: screen widths 1441px - 1920px
   * * `"xx-large"`: all screen widths from 1921px...
   * 
   * @precondition `$screen` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenType the targeted screensize flags as a bitmask
   * @return self for a fluent interface
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function showOnlyFor(string $screenType);

  /**
   * 
   * 
   * @return self for a fluent interface
   */
  public function clearVisibilitySettings();

  /**
   * Sets/unsets the component visible only for landscape orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return self for a fluent interface
   */
  public function hideForPortrait(bool $hide = true);

  /**
   * Sets/resets the component visible only for portrait orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return self for a fluent interface
   */
  public function hideForLandscape(bool $hide = true);

}
