<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Stdlib\Arrays;
use Sphp\Html\AbstractComponent;
use Sphp\Exceptions\BadMethodCallException;
use \Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Strings;
use Sphp\Html\Foundation\Sites\Core\FoundationSettings;

/**
 * Implements an XY Grid Cell
 *
 * 
 * @method $this small(int|string $sizeOrVisibility) sets the visibility or the size for small screens
 * @method $this medium(int|string $sizeOrVisibility) sets the visibility or the size for medium screens
 * @method $this large(int|string $sizeOrVisibility) sets the visibility or the size for large screens
 * @method $this xlarge(int|string $sizeOrVisibility) sets the visibility or the size for xlarge screens
 * @method $this xxlarge(int|string $sizeOrVisibility) sets the visibility or the size for xxlarge screens
 * @method $this smallOffset(int $offest = null) sets the offset for small screens
 * @method $this mediumOffset(int $offest = null) sets the offset for medium screens
 * @method $this largeOffset(int $offest = null) sets the offset for large screens
 * @method $this xlargeOffset(int $offest = null) sets the offset for xlarge screens
 * @method $this xxlargeOffset(int $offest = null) sets the offset for xxlarge screens
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractCell extends AbstractComponent implements Cell {

  /**
   * @var FoundationSettings 
   */
  private $settings;

  /**
   * Constructor
   * 
   * @param string $tagName
   * @param FoundationSettings $settings
   */
  public function __construct(string $tagName = 'div', FoundationSettings $settings = null) {
    parent::__construct($tagName);
    if ($settings === null) {
      $settings = FoundationSettings::default();
    }
    $this->settings = $settings;
    $this->cssClasses()->protectValue('cell');
    // $this->maxSize = $maxSize;
  }

  public function __destruct() {
    unset($this->settings);
    parent::__destruct();
  }

  /**
   * Sets a layout value for a screen size specific layout
   * 
   * @param  string $name
   * @param  array $arguments
   * @return $this for a fluent interface
   * @throws BadMethodCallException if the method does not exist or parameter is invalid
   */
  public function __call(string $name, array $arguments) {
    if (count($arguments) !== 1) {
      throw new BadMethodCallException("Wrong number of arguments for '$name' for Grid cell");
    }
    $parameter = $arguments[0];
    $screens = implode('|', $this->settings->getScreenSizes());
    if (Strings::match($name, "/^(($screens)Offset)+$/")) {
      $size = str_replace('Offset', '', $name);
      if (!is_int($parameter)) {
        $type = gettype($parameter);
        throw new BadMethodCallException("$type is invalid parameter type for $name method");
      }
      $this->setOffset($size, $parameter);
    } else if ($this->isScreenSize($name)) {
      if ($parameter === 'show') {
        $this->showOnlyFor($name);
      } else if ($parameter === 'hide') {
        $this->hideOnlyFor($name);
      } else {
        $this->setWidth($name, $parameter);
      }
    } else {
      throw new BadMethodCallException("'$name' is not valid method");
    }
    return $this;
  }

  public function setWidth(string $screen, $value) {
    $this->unsetWidth($screen);
    $this->cssClasses()->add("$screen-$value");
    return $this;
  }

  /**
   * Unsets the Cell width associated with the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetWidth(string $screenSize) {
    if (!$this->isScreenSize($screenSize)) {
      throw new InvalidArgumentException("Invalid screen size '$screenSize' given");
    }
    $this->cssClasses()->removePattern("/^($screenSize-([1-9]|(1[0-2])|auto|shrink))$/");
    return $this;
  }

  public function unsetWidths() {
    $screens = implode('|', $this->settings->getScreenSizes());
    $this->cssClasses()
            ->removePattern("/^(($screens)-([1-9]|(1[0-2]))|(auto|shrink))|(shrink|auto)$/");
    $this->cssClasses()->add('auto');
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
   * @param  string... $sizes the targeted screen sizes
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if a parameter is not a valid screen size
   */
  public function hideOnlyFor(string... $sizes) {
    foreach (Arrays::flatten($sizes) as $size) {
      if (!$this->isScreenSize($size)) {
        throw new InvalidArgumentException("Screen size '$size' was not recognized");
      } else {
        $this->cssClasses()->add("hide-for-$size-only");
        $this->cssClasses()->remove("show-for-$size-only");
      }
    }
    return $this;
  }

  /**
   * Shows the Cell for the given screen sizes only
   * 
   * Valid values for `$sizes` parameter:
   * 
   * * `"small"`: screen widths 0px - 640px
   * * `"medium"`: screen widths 641px - 1024px
   * * `"large"`: screen widths 1025px - 1440px)
   * * `"x-large"`: screen widths 1441px - 1920px
   * * `"xx-large"`: all screen widths from 1921px...
   * 
   * @precondition `$screen` == `small|medium|large|xlarge|xxlarge`
   * @param  string... $sizes the targeted screen sizes
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if a parameter is not a valid screen size
   */
  public function showOnlyFor(string... $sizes) {
    foreach (Arrays::flatten($sizes) as $size) {
      if (!$this->isScreenSize($size)) {
        throw new InvalidArgumentException("Screen size '$size' was not recognized");
      } else {
        $this->cssClasses()->add("show-for-$size-only");
        $this->cssClasses()->remove("hide-for-$size-only");
      }
    }
    return $this;
  }

  public function unsetVisibilitySettings() {
    $screens = implode('|', $this->settings->getScreenSizes());
    $this->cssClasses()
            ->removePattern("/^(hide-for-($screens)-only)+$/")
            ->removePattern("/^(show-for-($screens)-only)+$/");
    return $this;
  }

  public function setOffset(string $screenSize, int $value) {
    if (!$this->isScreenSize($screenSize)) {
      throw new InvalidArgumentException("Invalid screen size '$screenSize' given");
    }
    $this->unsetOffset($screenSize);
    if ($value > 0) {
      $this->cssClasses()->add("$screenSize-offset-$value");
    }
    return $this;
  }

  public function unsetOffset(string $screenSize) {
    if (!$this->isScreenSize($screenSize)) {
      throw new InvalidArgumentException("Invalid screen size '$screenSize' given");
    }
    $this->cssClasses()->removePattern("/^($screenSize-offset-([1-9]|(1[0-2])))$/");
    return $this;
  }

  public function unsetOffsets() {
    $screens = implode('|', $this->settings->getScreenSizes());
    $this->cssClasses()->removePattern("/^(($screens)-offset-([1-9]|(1[0-2])))$/");
    return $this;
  }

  /**
   * Sets cell order for given screen size
   * 
   * @param  string $screenSize the target screen size
   * @param  int $value
   * @return $this for a fluent interface
   */
  public function setOrder(string $screenSize, int $value) {
    $this->unsetOrder($screenSize);
    if ($value > 0) {
      $this->cssClasses()->add("$screenSize-order-$value");
    }
    return $this;
  }

  /**
   * Unsets the cell order for given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOrder(string $screenSize) {
    $this->cssClasses()->removePattern("/^($screenSize-order-([1-9]|(1[0-2])))+$/");
    return $this;
  }

  /**
   * Unsets the cell orders
   *
   * @return $this for a fluent interface
   */
  public function unsetOrders() {
    $screens = implode('|', $this->settings->getScreenSizes());
    $this->cssClasses()->removePattern("/^(($screens)-order-([1-9]|(1[0-2])))+$/");
    return $this;
  }

  public function reset() {
    $this->unsetWidths()->unsetOffsets()->unsetOrders();
    return $this;
  }

  public function setLayouts(...$layouts) {
    $this->reset();
    foreach (Arrays::flatten($layouts) as $cssClass) {
      if ($cssClass === 'auto' || $cssClass === 'shrink') {
        $this->{$cssClass}();
      } else {
        $this->fromCssClass($cssClass);
      }
    }
    return $this;
  }

  public function fromCssClass(string $cssClass) {
    $parts = explode('-', $cssClass);
    if (is_array($parts)) {
      $num = count($parts);
      if ($num === 3 && $parts[1] === 'offset') {
        $this->setOffset($parts[0], $parts[2]);
      } else if ($num === 4 && $parts[1] === 'show') {
        $this->setOffset($parts[0], $parts[2]);
      } else if ($num === 2) {
        $this->setWidth($parts[0], $parts[1]);
      } else {
        throw new InvalidArgumentException("'$cssClass' is not valid cell layout class");
      }
    } else {
      throw new InvalidArgumentException("'$cssClass' is not valid cell layout class");
    }
    return $this;
  }

  public function shrink() {
    $this->unsetWidths();
    $this->cssClasses()->add('shrink');
    return $this;
  }

  public function auto() {
    $this->unsetWidths();
    $this->cssClasses()->add('auto');
    return $this;
  }

  public function isScreenSize(string $needle): bool {
    return $this->settings->sizeExists($needle);
  }

}
