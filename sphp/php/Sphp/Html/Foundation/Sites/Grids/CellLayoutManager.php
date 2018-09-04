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
use ArrayAccess;
use Sphp\Html\CssClassifiableContent;
use Sphp\Html\Foundation\Sites\Core\ScreenSizes;
use Sphp\Html\Foundation\Foundation;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of CellLayoutManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CellLayoutManager extends AbstractLayoutManager implements ArrayAccess {

  /**
   * @var ScreenSizes 
   */
  private $screenSizes;

  /**
   * @var CellScreenSizeLayoutManager
   */
  private $screenLayouts = [];

  /**
   * @var int 
   */
  private $maxSize = 12;
  private static $offsets = ['shrink', 'auto'];

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
    foreach ($this->screenSizes as $size) {
      $this->screenLayouts[$size] = new CellScreenSizeLayoutManager($size, $component, $maxSize);
    }
    //$this->screenLayouts['all'] = $this;
    $this->cssClasses()->protect('cell');
    $this->maxSize = $maxSize;
  }

  public function __destruct() {
    unset($this->screenSizes, $this->screenLayouts);
    parent::__destruct();
  }

  /**
   * Sets a layout value for a screen size specific layout
   * 
   * @param  string $name
   * @param  array $arguments
   * @return CellScreenSizeLayoutManager
   * @throws BadMethodCallException
   */
  public function __call(string $name, array $arguments): CellScreenSizeLayoutManager {
    if (!$this->isScreenSize($name)) {
    throw new \Sphp\Exceptions\BadMethodCallException("Invalid size '$name' for Grid cell");
    } if (count($arguments) === 1) {
      return $this->screen($name)[$arguments[0]];
    } else {
    throw new \Sphp\Exceptions\BadMethodCallException("Wrong number of arguments foe '$name' for Grid cell");
    }
  }

  public function setLayouts(...$layouts) {
    foreach (Arrays::flatten($layouts) as $cssClass) {
      if (in_array($cssClass, static::$offsets)) {
        $this->setOneOf(static::$offsets, $cssClass);
      }
    }
    foreach ($this->screenLayouts as $l) {
      $l->setLayouts($layouts);
    }
    return $this;
  }

  public function unsetLayouts() {
    foreach ($this->screenLayouts as $l) {
      $l->unsetLayouts();
    }
    $this->cssClasses()->remove('shrink', 'auto');
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  string|int|null $value column size for this screens sizes
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function size($value) {
    $all = ['shrink', 'auto'];
    if ($value !== null && !array_key_exists($value, $all) && $this->maxSize < $value && $value < 0) {
      throw new InvalidArgumentException("Invalid size '$value' for Grid cell");
    }
    $this->unsetSize();
    if (in_array($value, $all)) {
      $this->cssClasses()->set($value);
    }
    if ($value !== null) {
      $this->screen('small')->size($value);
    }
    return $this;
  }

  public function shrink() {
    $this->unsetSizes();
    $this->cssClasses()->add('shrink');
    return $this;
  }

  public function auto() {
    $this->unsetSizes();
    $this->cssClasses()->add('auto');
    return $this;
  }

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens

   * @return $this for a fluent interface
   */
  public function unsetSizes() {
    $this->cssClasses()->remove('shrink', 'auto');
    foreach ($this->screenLayouts as $layout) {
      $layout->clearSize();
    }
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  string $size screen size 
   * @return CellScreenSizeLayoutManager
   */
  public function screen(string $size): CellScreenSizeLayoutManager {
    if (!isset($this->screenLayouts[$size])) {
      throw new InvalidArgumentException('ScreenSize does not exist');
    }
    return $this->screenLayouts[$size];
  }

  public function all(): CellLayoutManager {
    return $this;
  }

  public function isScreenSize(string $needle): bool {
    return array_key_exists($needle, $this->screenLayouts);
  }

  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->screenLayouts) || in_array($offset, static::$offsets);
  }

  public function offsetGet($offset) {
    if ($this->offsetExists($offset)) {
      return $this->screenLayouts[$offset];
    }
    throw new InvalidArgumentException("Invalid size '$offset' for Grid cell");
  }

  public function offsetSet($offset, $value) {
    throw new \Sphp\Exceptions\InvalidArgumentException();
  }

  /**
   * 
   * @param  mixed $offset
   * @throws InvalidArgumentException
   */
  public function offsetUnset($offset) {
    if ($this->isScreenSize($offset)) {
      $this->screenLayouts->unsetLayouts();
    } else {
      throw new InvalidArgumentException("Invalid size '$offset' for Grid cell");
    }
  }

}
