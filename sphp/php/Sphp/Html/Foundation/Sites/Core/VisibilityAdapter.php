<?php

/**
 * VisibilityHandler.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Adapters\AbstractComponentAdapter;
use Sphp\Html\ComponentInterface;

/**
 * Implements {@link VisibilityChanger} interface functionality
 * 
 * {@link VisibilityInterface} Defines styled CSS visibility settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-29
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VisibilityAdapter extends AbstractComponentAdapter implements VisibilityChanger {

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component) {
    parent::__construct($component);
  }

  /**
   * Clears all Foundation based visibility CSS classes
   * 
   * @return self for a fluent interface
   */
  public function showForAllScreenSizes() {
    $cssClasses = [];
    foreach (Screen::sizes() as $screen) {
      $cssClasses[] = "show-for-$screen-only";
      $cssClasses[] = "show-for-$screen";
      $cssClasses[] = "hide-for-$screen-only";
      $cssClasses[] = "hide-for-$screen";
    }
    $this->getComponent()->cssClasses()
            ->remove($cssClasses);
    return $this;
  }

  /**
   * 
   * @param  string $screenType
   * @return self for a fluent interface
   * @throws InvalidArgumentException
   */
  public function showFromUp($screenType) {
    if (!in_array($screenType, Screen::sizes())) {
      throw new InvalidArgumentException("Screen type '$screenType' was not recognized");
    }
    $this->getComponent()->cssClasses()
            ->add("show-for-$screenType")
            ->remove("hide-for-$screenType");
    return $this;
  }

  /**
   * 
   * @param string $screenSize
   * @return self for a fluent interface
   * @throws InvalidArgumentException
   */
  public function hideDownTo($screenSize) {
    $this->showForAllScreenSizes();
    if (!Screen::sizeExists($screenSize)) {
      throw new InvalidArgumentException("Screen type '$screenSize' was not recognized");
    }
    if ($screenSize == 'small') {
      $this->getComponent()->cssClasses()
              ->add('hide');
    }
    $this->getComponent()->cssClasses()
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
   * @return self for a fluent interface
   */
  public function showBetweenSizes($smaller, $larger) {
    $this->showForAllScreenSizes();
    $upper = Screen::getNextSize($larger);
    if ($upper !== false) {
      $this->getComponent()->cssClasses()
              ->add(["hide-for-$upper"]);
    }
    if ($smaller != 'small') {
      $this->getComponent()->cssClasses()
              ->add(["show-for-$smaller", "hide-for-$upper"]);
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
   * @param  string $size the targeted screen size flags as a bitmask
   * @return self for a fluent interface
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function hideOnlyFromSize($size) {
    $this->showForAllScreenSizes();
    if (Screen::sizeExists($size)) {
      $this->getComponent()->cssClasses()
              ->add("hide-for-$size-only");
    } else {
      throw new InvalidArgumentException("Screen size '$size' was not recognized");
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
   * @param  int|string $screenType the targeted screen type
   * @return self for a fluent interface
   * @throws InvalidArgumentException if the parameter is not recognized as a 
   *         valid screen size
   */
  public function showOnlyFor($screenType) {
    $onlyFor = function($size) {
      if (!Screen::sizeExists($size)) {
        throw new InvalidArgumentException("Screen type '$size' was not recognized");
      }
      $this->getComponent()->cssClasses()
              ->add("show-for-$size-only");
    };
    if (func_num_args() === 1) {
      $onlyFor($screenType);
    } else {
      foreach (func_get_args() as $screen) {
        $onlyFor($screen);
      }
    }
    return $this;
  }

  /**
   * Sets the componentvisible for all screen sizes
   * 
   * @return self for a fluent interface
   */
  public function showForAllSizes() {
    $classes = [];
    foreach (Screen::sizes() as $sreenName) {
      $classes[] = "hide-for-$sreenName";
      $classes[] = "hide-for-$sreenName-only";
      $classes[] = "show-for-$sreenName";
      $classes[] = "show-for-$sreenName-only";
    }
    $this->getComponent()->cssClasses()
            ->remove($classes);
    return $this;
  }

  /**
   * 
   * 
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   */
  public function hideForPortrait($hide = true) {
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
   * @return self for a fluent interface
   */
  public function hideForLandscape($hide = true) {
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

}
