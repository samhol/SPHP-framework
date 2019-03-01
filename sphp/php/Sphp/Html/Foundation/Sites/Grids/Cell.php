<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\CssClassifiableContent;

/**
 * Defines an XY Grid Cell
 *
 * **Important!**
 *
 * This component is mobile-first. Code for small screens first,
 * and larger devices will inherit those styles. Customize for
 * larger screens as necessary
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Cell extends CssClassifiableContent {

  /**
   * Sets the Cell width associated with the given screen size
   *  
   * @param string $screen
   * @param  string|int|null $value
   * @return $this for a fluent interface
   */
  public function setWidth(string $screen, $value);

  /**
   * Unsets the Cell width associated with the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetWidth(string $screenSize);

  /**
   * Unsets all widths
   * 
   * @return $this for a fluent interface
   */
  public function unsetWidths();

  /**
   * Sets an offset for given screen size
   * 
   * @param  string $screenSize the target screen size
   * @param  int $value
   * @return $this for a fluent interface
   */
  public function setOffset(string $screenSize, int $value);

  /**
   * Unsets an offset for given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOffset(string $screenSize);

  /**
   * Unsets the cell offsets
   *
   * @return $this for a fluent interface
   */
  public function unsetOffsets();

  /**
   * Sets cell order for given screen size
   * 
   * @param  string $screenSize the target screen size
   * @param  int $value
   * @return $this for a fluent interface
   */
  public function setOrder(string $screenSize, int $value);

  /**
   * Unsets the cell order for given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOrder(string $screenSize);

  /**
   * Unsets the cell orders
   *
   * @return $this for a fluent interface
   */
  public function unsetOrders();

  /**
   * Rsets the Cell layout

   * @return $this for a fluent interface
   */
  public function reset();

  /**
   * 
   * 
   * @param  string[]|... string $layouts
   * @return $this for a fluent interface
   */
  public function setLayouts(...$layouts);

  /**
   * 
   * 
   * @param  string $cssClass
   * @return $this for a fluent interface
   */
  public function fromCssClass(string $cssClass);

  /**
   * 
   * 
   * @return $this for a fluent interface
   */
  public function shrink();

  /**
   * 
   * 
   * @return $this for a fluent interface
   */
  public function auto();
}
