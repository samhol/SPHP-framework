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
use Sphp\Html\Foundation\Sites\Core\Screen;

/**
 * Description of CellLayoutManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CellLayoutManager extends AbstractLayoutManager implements ArrayAccess {

  /**
   * @var CellScreenSizeLayoutManager
   */
  private $screenLayouts = [];
  private $maxSize = 12;
  
  private static $offsets = ['shrink', 'auto'];

  /**
   * Constructor
   * 
   * @param CssClassifiableContent $component
   * @param int $maxSize
   */
  public function __construct(CssClassifiableContent $component, int $maxSize = 12) {
    parent::__construct($component);
    foreach (Screen::sizes() as $size) {
      $this->screenLayouts[$size] = new CellScreenSizeLayoutManager($size, $component, $maxSize);
    }
    //$this->screenLayouts['all'] = $this;
    $this->cssClasses()->protect('cell');
    $this->maxSize = $maxSize;
  }

  public function setLayouts(...$layouts) {
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
    $this->unsetSize();
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
    return $this->screenLayouts[$size];
  }

  public function all(): CellLayoutManager {
    return $this;
  }

  public function isScreenSize(string $needle): bool {
    return array_key_exists($needle, $this->screenLayouts);
  }

  public function offsetExists($offset): bool {
    $exists = false;
    if (array_key_exists($offset, $this->screenLayouts) ) {
      $exists = true;
    } else if (in_array($offset, static::$offsets)) {
      $exists = true;
    }
    return $exists;
  }

  public function offsetGet($offset) {
    if ($this->offsetExists($offset)) {
      return $this->screenLayouts[$offset];
    }
    throw new \Sphp\Exceptions\InvalidArgumentException();
  }

  public function offsetSet($offset, $value) {
    throw new \Sphp\Exceptions\InvalidArgumentException();
  }

  public function offsetUnset($offset) {
    
    throw new \Sphp\Exceptions\InvalidArgumentException();
  }

}
