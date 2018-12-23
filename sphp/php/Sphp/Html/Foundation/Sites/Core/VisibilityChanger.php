<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

/**
 * Defines Visibility Controls for HTML content
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface VisibilityChanger {

  /**
   * Sets the component visible for all screen sizes
   * 
   * @return $this for a fluent interface
   */
  public function showForAll();

  /**
   * Hides the component for the given screen sizes only
   * 
   * Valid flags for `$size` parameter:
   * 
   * * `"small"`: screen widths 0px - 640px
   * * `"medium"`: screen widths 641px - 1024px
   * * `"large"`: screen widths 1025px - 1440px)
   * * `"xlarge"`: screen widths 1441px - 1920px
   * * `"xxlarge"`: all screen widths from 1921px...
   * 
   * @precondition `$screen` == `small|medium|large|xlarge|xxlarge`
   * @param  string|string[] $sizes the targeted screen sizes
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function hideOnlyForSize(... $sizes);

  /**
   * Shows the component for the given screen sizes only
   * 
   * Valid flags for `$size` parameter:
   * 
   * * `"small"`: screen widths 0px - 640px
   * * `"medium"`: screen widths 641px - 1024px
   * * `"large"`: screen widths 1025px - 1440px)
   * * `"xlarge"`: screen widths 1441px - 1920px
   * * `"xxlarge"`: all screen widths from 1921px...
   * 
   * @precondition `$screen` == `small|medium|large|xlarge|xxlarge`
   * @param  string $size the targeted screen sizes
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function showOnlyFor(string $size);

  /**
   * Sets/unsets the component visible only for landscape orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return $this for a fluent interface
   */
  public function hideForPortrait(bool $hide = true);

  /**
   * Sets/resets the component visible only for portrait orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return $this for a fluent interface
   */
  public function hideForLandscape(bool $hide = true);
}
