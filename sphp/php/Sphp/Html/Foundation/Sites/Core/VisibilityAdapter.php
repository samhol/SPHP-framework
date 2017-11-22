<?php

/**
 * VisibilityAdapter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\CssClassifiedComponent;
use Sphp\Stdlib\Arrays;

/**
 * Implements Visibility changer functionality
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VisibilityAdapter extends AbstractLayoutManager implements VisibilityChanger {

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $component
   */
  public function __construct(CssClassifiedComponent $component) {
    parent::__construct($component);
  }

  /**
   * Clears all Foundation based visibility CSS classes
   * 
   * @return $this for a fluent interface
   */
  public function showForAllScreenSizes() {
    $cssClasses = [];
    foreach (Screen::sizes() as $screen) {
      $cssClasses[] = "show-for-$screen-only";
      $cssClasses[] = "show-for-$screen";
      $cssClasses[] = "hide-for-$screen-only";
      $cssClasses[] = "hide-for-$screen";
    }
    $this->cssClasses()
            ->remove($cssClasses);
    return $this;
  }

  /**
   * 
   * @param  string $screenType
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function showFromUp(string $screenType) {
    if (!in_array($screenType, Screen::sizes())) {
      throw new InvalidArgumentException("Screen type '$screenType' was not recognized");
    }
    $this->cssClasses()
            ->add("show-for-$screenType")
            ->remove("hide-for-$screenType");
    return $this;
  }

  /**
   * 
   * @param string $screenSize
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function hideDownTo($screenSize) {
    $this->showForAllScreenSizes();
    if (!Screen::sizeExists($screenSize)) {
      throw new InvalidArgumentException("Screen type '$screenSize' was not recognized");
    }
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
   * Overrides all previous sreen size related visibility settings
   * 
   * @param  string $smaller
   * @param  string $larger
   * @return $this for a fluent interface
   */
  public function showBetweenSizes(string $smaller, string $larger) {
    $this->showForAllScreenSizes();
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
    $sizes = Arrays::flatten($sizes); //hide-for-large-only
    //$filtered = preg_grep('/^hide-for-(small|medium|large|xlarge|xxlarge)-only$/', $widths);
    foreach (Arrays::flatten($sizes) as $size) {
      if (!Screen::sizeExists($size)) {
        throw new InvalidArgumentException("Screen size '$size' was not recognized");
      } else {
        $this->cssClasses()
                ->add("hide-for-$size-only")->remove("show-for-$size-only");
      }
    }
    return $this;
  }

  /**
   * Shows component visible for the given screen sizes only
   * 
   * Valid flags for `$size` parameter:
   * 
   * * `"small"`: screen widths 0px - 640px
   * * `"medium"`: screen widths 641px - 1024px
   * * `"large"`: screen widths 1025px - 1440px)
   * * `"x-large"`: screen widths 1441px - 1920px
   * * `"xx-large"`: all screen widths from 1921px...
   * 
   * @precondition `$size` == `small|medium|large|xlarge|xxlarge`
   * @param  int|string $sizes the targeted screen sizes
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function showOnlyFor(... $sizes) {
    $sizes = Arrays::flatten($sizes); //hide-for-large-only
    //$filtered = preg_grep('/^hide-for-(small|medium|large|xlarge|xxlarge)-only$/', $widths);
    foreach (Arrays::flatten($sizes) as $size) {
      if (!Screen::sizeExists($size)) {
        throw new InvalidArgumentException("Screen size '$size' was not recognized");
      } else {
        $this->cssClasses()
                ->add("show-for-$size-only")->remove("hide-for-$size-only");
      }
    }
    return $this;
  }

  /**
   * Sets the component visible for all screen sizes
   * 
   * @return $this for a fluent interface
   */
  public function showForAllSizes() {
    $classes = [];
    foreach (Screen::sizes() as $sreenName) {
      $classes[] = "hide-for-$sreenName";
      $classes[] = "hide-for-$sreenName-only";
      $classes[] = "show-for-$sreenName";
      $classes[] = "show-for-$sreenName-only";
    }
    $this->cssClasses()
            ->remove($classes);
    return $this;
  }

  /**
   * 
   * 
   * @return $this for a fluent interface
   */
  public function clearVisibilitySettings() {
    $classes = [];
    foreach (self::$sreenMap as $sreenName) {
      $classes[] = "hidden-for-$sreenName";
      $classes[] = "show-for-$sreenName";
    }
    $this->getComponent()->cssClasses()
            ->remove($classes);
    return $this;
  }

  /**
   * Sets/unsets the component visible only for landscape orientation
   * 
   * @param  boolean $hide true if hidden, false otherwise
   * @return $this for a fluent interface
   */
  public function hideForPortrait(bool $hide = true) {
    $this->getComponent()->cssClasses()
            ->remove('show-for-portrait');
    if ($hide) {
      $this->getComponent()->cssClasses()
              ->add('show-for-landscape');
    } else {
      $this->getComponent()->cssClasses()
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
    $this->getComponent()->cssClasses()
            ->remove('show-for-landscape');
    if ($hide) {
      $this->getComponent()->cssClasses()
              ->add('show-for-portrait');
    } else {
      $this->getComponent()->cssClasses()
              ->remove('show-for-portrait');
    }
    return $this;
  }

  public function setLayouts(...$layouts) {
    
  }

  public function unsetLayouts() {
    $classes = [];
    foreach (Screen::sizes() as $sreenName) {
      $classes[] = "hide-for-$sreenName";
      $classes[] = "hide-for-$sreenName-only";
      $classes[] = "show-for-$sreenName";
      $classes[] = "show-for-$sreenName-only";
    }
    $this->cssClasses()
            ->remove($classes);
    return $this;
  }

}
