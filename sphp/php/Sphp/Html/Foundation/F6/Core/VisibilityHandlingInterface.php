<?php

/**
 * VisibilityHandlingInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Core;


/**
 * Interface defines Foudation Screen Size Visibility Control settings
 * 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-29
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation 6
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface VisibilityHandlingInterface {

  /**
   * Clears all Foundation based visibility CSS classes
   * 
   * @return self for PHP Method Chaining
   */
  public function showForAllScreenSizes();

  /**
   * Hidden the component for the given screen sizes
   * 
   * Valid flags for <var>$screenSizes</var> parameter (PHP constants):
   * 
   * @precondition
   * 
   * * {@link Screen::SMALL} or `"small-only"`: screen widths 0px - 640px
   * * {@link Screen::MEDIUM} or `"medium-only"`: screen widths 641px - 1024px
   * * {@link Screen::MEDIUM_UP} or `"medium-up"`: all screen widths from 641px...
   * * {@link Screen::LARGE} or `"large-only"`: screen widths 1025px - 1440px)
   * * {@link Screen::LARGE_UP} or `"large-up"`: all screen widths from 1025px...
   * * {@link Screen::X_LARGE} or `"x-large-only"`: screen widths 1441px - 1920px
   * * {@link Screen::X_LARGE_UP} or `"x-large-up"`: all screen widths from 1441px...
   * * {@link Screen::PORTRAIT} or `"portrait"`: portrait oriented screens
   * * {@link Screen::LANDSCAPE} or `"landscape"`: landscape oriented screens
   * * {@link Screen::TOUCH} or `"touch"`: device supports touch (as determined by Modernizr).
   * * {@link Screen::SCREENREADER} or `"sr"`:  Screen Readers
   * 
   * @param  int|string $screenType the targeted screensize flags as a bitmask
   * @return self for PHP Method Chaining
   * @throws \InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function hideOnlyFrom($screenType);

  /**
   * Sets the component visible for the given screen sizes
   * 
   * Valid flags for <var>$screenSizes</var> parameter (PHP constants):
   * 
   * * {@link Screen::SMALL} for small screen (width: 0px - 640px)
   * * {@link Screen::MEDIUM} for medium screen (width: 641px - 1024px)
   * * {@link Screen::MEDIUM_UP} for all screens from medium up (width: 641px...)
   * * {@link Screen::LARGE} for large screen (width: 1025px - 1440px)
   * * {@link Screen::LARGE_UP} for all screens from large up (width: 1025px...)
   * * {@link Screen::X_LARGE} for X-large screen (width: 1441px - 1920px)
   * * {@link Screen::X_LARGE_UP} for all screens from x-large up (width: 1441px...)
   * * {@link Screen::XX_LARGE} for XX-large screen (width: 1921px...)
   * * {@link Screen::ALL_SIZES} for all screens
   * 
   * @param  int|string $screenType the targeted screen type
   * @return self for PHP Method Chaining
   * @throws \InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function showOnlyFor($screenType);

  /**
   * 
   * 
   * @return self for PHP Method Chaining
   */
  public function clearVisibilitySettings();

  /**
   * Sets/unsets the component visible only for landscape orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return self for PHP Method Chaining
   */
  public function hideForPortrait($hide = true);

  /**
   * Sets/resets the component visible only for portrait orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return self for PHP Method Chaining
   */
  public function hideForLandscape($hide = true);

  /**
   * Hide/shows the component for touch screen devices (as determined by 
   * {@link http://modernizr.com/ modernizr})
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return self for PHP Method Chaining
   */
  public function hideForTouchScreenDevices($hide = true);

  /**
   * Hide/shows the component for non touch screen devices (as determined by 
   * {@link http://modernizr.com/ modernizr})
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return self for PHP Method Chaining
   */
  public function hideForNonTouchScreenDevices($hide = true);
}
