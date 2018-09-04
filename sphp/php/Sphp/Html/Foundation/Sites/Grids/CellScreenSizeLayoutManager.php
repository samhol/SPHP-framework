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
use ArrayAccess;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of ScreenSizeLayoutManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CellScreenSizeLayoutManager extends AbstractLayoutManager implements ArrayAccess {

  /**
   * @var string
   */
  private $screenSize;

  /**
   * @var string[]
   */
  private $sizes = [];

  /**
   * @var string[]
   */
  private $offsets = [];

  /**
   * @var string[]
   */
  private $orders = [];

  /**
   * Constructor
   * 
   * @param string $screenSize
   * @param CssClassifiableContent $component
   * @param int $maxSize
   */
  public function __construct(string $screenSize, CssClassifiableContent $component, int $maxSize = 12) {
    parent::__construct($component);
    $this->screenSize = $screenSize;
    $this->cssClasses()->protect('cell');
    $this->createSizes($maxSize);
  }

  protected function createSizes(int $maxSize) {
    for ($size = 1; $size <= $maxSize; $size++) {
      $this->sizes[$size] = "$this->screenSize-$size";
    }
    $this->sizes['auto'] = "$this->screenSize-auto";
    $this->sizes['shrinks'] = "$this->screenSize-shrink";
    for ($size = 1; $size <= $maxSize; $size++) {
      $this->offsets[$size] = "$this->screenSize-offset-$size";
    }
    for ($size = 1; $size <= $maxSize; $size++) {
      $this->orders[$size] = "$this->screenSize-order-$size";
    }
  }

  public function setLayouts(...$layouts) {
    foreach (Arrays::flatten($layouts) as $cssClass) {
      $size = array_search($cssClass, $this->sizes);
      if ($size !== false) {
        $this->size($size);
      }
    }
    return $this;
  }

  public function unsetLayouts() {
    $this->clearSize()
            ->clearOffset()->clearOrder();
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  string|int|null $value column size for this screens sizes
   * @return $this for a fluent interface
   */
  public function size($value) {
    if ($value !== null && !array_key_exists($value, $this->sizes)) {
      throw new InvalidArgumentException("Invalid size '$value' for Grid cell");
    }
    $this->clearSize();
    if ($value !== null) {
      $this->cssClasses()->add($this->sizes[$value]);
    }
    return $this;
  }

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens

   * @return $this for a fluent interface
   */
  public function clearSize() {
    $this->cssClasses()->remove($this->sizes);
    return $this;
  }

  /**
   * Offsets the column component to right on the associated screen sizes
   * 
   * Moves Column block up to 11 columns to the right.
   *
   * @param  int $offset the column offsets value
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the offset is invalid
   */
  public function offset(int $offset) {
    if ($offset !== 0 && !array_key_exists($offset, $this->offsets)) {
      throw new InvalidArgumentException("Invalid offset '$offset' for Grid cell");
    }
    $this->clearOffset();
    if ($offset !== 0) {
      $this->cssClasses()->add($this->offsets[$offset]);
    }
    return $this;
  }

  /**
   * Unsets the grid offset for the given screen size
   *
   * @return $this for a fluent interface
   */
  public function clearOffset() {
    $this->cssClasses()->remove($this->offsets);
    return $this;
  }

  /**
   * 
   * @param int $order
   * @return $this
   * @throws InvalidArgumentException
   */
  public function order(int $order = null) {
    if ($order !== null && !array_key_exists($order, $this->orders)) {
      throw new InvalidArgumentException("Invalid order '$order' for Grid cell");
    }
    $this->clearOrder();
    if ($order !== null) {
      $this->cssClasses()->add($this->orders[$order]);
    }
    return $this;
  }

  /**
   * Unsets the grid offset for the given screen size
   *
   * @return $this for a fluent interface
   */
  public function clearOrder() {
    $this->cssClasses()->remove($this->orders);
    return $this;
  }

  public function offsetExists($offset): bool {
    return in_array($offset, ['size', 'offset', 'order']);
  }

  public function offsetGet($offset) {
    if ($this->offsetExists($offset)) {
      return $this->screenLayouts[$offset];
    }
    throw new \Sphp\Exceptions\InvalidArgumentException();
  }

  public function offsetSet($offset, $value) {
    if ($this->offsetExists($offset)) {
      $this->$offset($value);
    } else {
      throw new \Sphp\Exceptions\InvalidArgumentException();
    }
  }

  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      $methodName = 'clear' . ucfirst($offset);
      $this->$methodName();
    } else {
      throw new \Sphp\Exceptions\InvalidArgumentException();
    }
  }

}
