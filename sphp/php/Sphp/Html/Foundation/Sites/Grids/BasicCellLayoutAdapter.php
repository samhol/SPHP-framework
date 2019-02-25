<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Foundation\Sites\Core\AbstractLayoutManager;
use Sphp\Html\CssClassifiableContent;
use Sphp\Html\Foundation\Sites\Core\ScreenSizes;
use Sphp\Html\Foundation\Foundation;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Stdlib\Strings;

/**
 * Implements Foundation XY Grid call layout adapter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html#basics XY Grid cell
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BasicCellLayoutAdapter extends AbstractLayoutManager implements CellLayoutAdapter{

  /**
   * @var ScreenSizes 
   */
  private $screenSizes;

  /**
   * @var int 
   */
  private $maxSize = 12;

  /**
   * Constructor
   * 
   * @param CssClassifiableContent $component
   * @param ScreenSizes $screenSizes
   * @param int $maxSize
   */
  public function __construct(CssClassifiableContent $component, ScreenSizes $screenSizes = null, int $maxSize = 12) {
    parent::__construct($component);
    if ($screenSizes === null) {
      $screenSizes = Foundation::screen();
    }
    $this->screenSizes = $screenSizes;
    $this->cssClasses()->setValue('cell');
    $this->maxSize = $maxSize;
  }

  public function __destruct() {
    unset($this->screenSizes);
    parent::__destruct();
  }

  /**
   * Sets a layout value for a screen size specific layout
   * 
   * @param  string $name
   * @param  array $arguments
   * @return $this for a fluent interface
   * @throws BadMethodCallException
   */
  public function __call(string $name, array $arguments) {
    if (Strings::endsWith($name, 'Offset')) {
      $size = str_replace('Offset', '', $name);
      $this->setOffset($size, $arguments[0]);
    } else if ($this->isScreenSize($name)) {
      $this->setWidth($name, $arguments[0]);
    } else if ($name === 'shrink') {
      $this->setWidth($name, $arguments[0]);
    } else {
      throw new BadMethodCallException("Wrong number of arguments foe '$name' for Grid cell");
    }
  }

  public function setWidth(string $screen, $value) {
    $this->unsetWidth($screen);
    $this->cssClasses()->add("$screen-$value");
    return $this;
  }

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetWidth(string $screenSize) {
    $this->cssClasses()->removePattern("/^(($screenSize)-([1-9]|(1[0-2])|auto|shrink))+$/");
    return $this;
  }

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens

   * @return $this for a fluent interface
   */
  public function resetWidths() {
    $this->cssClasses()->removePattern("/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto))|shrink|auto+$/");
    $this->cssClasses()->add('auto');
    return $this;
  }

  /**
   * Sets an offset for given screen size
   * 
   * @param  string $screenSize the target screen size
   * @param  int $value
   * @return $this for a fluent interface
   */
  public function setOffset(string $screenSize, int $value) {
    $this->unsetOffset($screenSize);
    if ($value > 0) {
      $this->cssClasses()->add("$screenSize-offset-$value");
    }
    return $this;
  }

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOffset(string $screenSize) {
    $this->cssClasses()->removePattern("/^(($screenSize)-offset-([1-9]|(1[0-2])))+$/");
    return $this;
  }

  /**
   * Unsets the cell offsets
   *
   * @return $this for a fluent interface
   */
  public function unsetOffsets() {
    $this->cssClasses()->removePattern("/^((small|medium|large|xlarge|xxlarge)-offset-([1-9]|(1[0-2])))+$/");
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
    $this->unsetOffset($screenSize);
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
    $this->cssClasses()->removePattern("/^(($screenSize)-order-([1-9]|(1[0-2])))+$/");
    return $this;
  }

  /**
   * Unsets the cell orders
   *
   * @return $this for a fluent interface
   */
  public function unsetOrders() {
    $this->cssClasses()->removePattern("/^((small|medium|large|xlarge|xxlarge)-order-([1-9]|(1[0-2])))+$/");
    return $this;
  }

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens

   * @return $this for a fluent interface
   */
  public function reset() {
    $this->resetWidths()->unsetOffsets()->unsetOrders();
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  ...string|string[] $widths column widths for different screens sizes
   * @return $this for a fluent interface
   */
  public function setWidths(... $widths) {
    $widths = Arrays::flatten($widths);
    $this->unsetWidths();
    $filtered = preg_grep('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/', $widths);
    $this->cssClasses()->add($filtered);
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
    $this->resetWidths();
    $this->cssClasses()->add('shrink');
    return $this;
  }

  public function auto() {
    $this->resetWidths();
    return $this;
  }

  public function isScreenSize(string $needle): bool {
    return $this->screenSizes->sizeExists($needle);
  }

}
