<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Adapters\AbstractCssClassAdapter;
use Sphp\Html\Foundation\Sites\Core\VisibilityChanger;
use Sphp\Stdlib\Arrays;
use Sphp\Html\CssClassifiableContent;
use Sphp\Html\Foundation\Sites\Core\ScreenSizes;

/**
 * Implements Visibility changer functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VisibilityAdapter extends AbstractCssClassAdapter implements VisibilityChanger {

  /**
   * @var ScreenSizes 
   */
  private $sizes;

  /**
   * Constructor
   * 
   * @param CssClassifiableContent $component
   */
  public function __construct(CssClassifiableContent $component) {
    parent::__construct($component);
    $this->sizes = new ScreenSizes();
  }

  public function __destruct() {
    unset($this->sizes);
    parent::__destruct();
  }

  /**
   * Sets the layouts
   *
   * @param  string|string[] $layouts layout parameters (CSS classes)
   * @return $this for a fluent interface
   */
  public function setLayouts(... $layouts) {
    $sizePatt = "(small|medium|large|xlarge|xxlarge)";
    $arr = Arrays::flatten($layouts);
    //$show = $this->parsePattern($layouts, "/^(show-for-$sizePatt)+$/");
    $show = preg_grep("/^(show-for-$sizePatt)+$/", $arr);
    foreach (str_replace('show-for-', '', $show) as $showFor) {
      $this->showFromUp($showFor);
    }
    $show = preg_grep("/^(show-for-$sizePatt-only)+$/", $arr);
    foreach (str_replace(['show-for-', '-only'], '', $show) as $showFor) {
      $this->showFromUp($unit);
    }
    return $this;
  }

  /**
   * 
   * @param  string $screenType
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function showFromUp(string $screenType) {
    if (!$this->sizes->sizeExists($screenType)) {
      throw new InvalidArgumentException("Screen type '$screenType' was not recognized");
    }
    $this->showForAll();
    $this->cssClasses()
            ->add("show-for-$screenType");
    return $this;
  }

  /**
   * 
   * @param string $screenSize
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function hideDownTo($screenSize) {
    if (!$this->sizes->sizeExists($screenSize)) {
      throw new InvalidArgumentException("Screen type '$screenType' was not recognized");
    }
    $this->showForAll();
    if ($screenSize == 'small') {
      $this->cssClasses()
              ->add('hide');
    }
    $this->cssClasses()
            ->add("hide-for-$screenSize");
    return $this;
  }

  /**
   * **Important!**
   * 
   * Overrides all previous screen size related visibility settings
   * 
   * @param  string $smaller
   * @param  string $larger
   * @return $this for a fluent interface
   */
  public function showBetweenSizes(string $smaller, string $larger) {
    $this->showForAll();
    $upper = Screen::getNextSize($larger);
    if ($upper !== false) {
      $this->cssClasses()
              ->add("hide-for-$upper");
    }
    if ($smaller != 'small') {
      $this->cssClasses()
              ->add("show-for-$smaller", "hide-for-$upper");
    }
    return $this;
  }

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
   * @param  string|string[] $sizes the targeted screen sizes
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function hideOnlyForSize(... $sizes) {
    $this->showForAll();
    foreach (Arrays::flatten($sizes) as $size) {
      if (!$this->sizes->sizeExists($size)) {
        throw new InvalidArgumentException("Screen size '$size' was not recognized");
      } else {
        $this->cssClasses()
                ->add("hide-for-$size-only");
      }
    }
    return $this;
  }

  /**
   * Shows component visible for the given screen sizes only
   * 
   * Valid values for `$size` parameter:
   * 
   * * `"small"`: screen widths 0px - 640px
   * * `"medium"`: screen widths 641px - 1024px
   * * `"large"`: screen widths 1025px - 1440px)
   * * `"x-large"`: screen widths 1441px - 1920px
   * * `"xx-large"`: all screen widths from 1921px...
   * 
   * @precondition `$size` == `small|medium|large|xlarge|xxlarge`
   * @param  string $size the targeted screen size
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function showOnlyFor(string $size) {
    if (!$this->sizes->sizeExists($size)) {
      throw new InvalidArgumentException("Screen type '$size' was not recognized");
    }
    $this->showForAll();
    $this->cssClasses()->add("show-for-$size-only");
    return $this;
  }

  /**
   * Sets the component visible for all screen sizes
   * 
   * @return $this for a fluent interface
   */
  public function showForAll() {
    $classes = ['hide'];
    foreach ($this->sizes as $size) {
      $classes[] = "hide-for-$size";
      $classes[] = "hide-for-$size-only";
      $classes[] = "show-for-$size";
      $classes[] = "show-for-$size-only";
    }
    $this->cssClasses()->remove($classes);
    return $this;
  }

  /**
   * Sets/unsets the component visible only for landscape orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return $this for a fluent interface
   */
  public function hideForPortrait(bool $hide = true) {
    $this->cssClasses()
            ->remove('show-for-portrait');
    if ($hide) {
      $this->cssClasses()
              ->add('show-for-landscape');
    } else {
      $this->cssClasses()
              ->remove('show-for-landscape');
    }
    return $this;
  }

  /**
   * Sets/resets the component visible only for portrait orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return $this for a fluent interface
   */
  public function hideForLandscape(bool $hide = true) {
    $this->cssClasses()
            ->remove('show-for-landscape');
    if ($hide) {
      $this->cssClasses()
              ->add('show-for-portrait');
    } else {
      $this->cssClasses()
              ->remove('show-for-portrait');
    }
    return $this;
  }

}
