<?php

/**
 * SizeableInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\ContentInterface;

/**
 * Interface models sizing of various HTML media components

 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-15
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface SizeableInterface extends ContentInterface {

  /**
   * Sets the dimensions of the component (in pixels)
   * 
   * @param  Size $size object containing the dimension settings
   * @return self for PHP Method Chaining
   */
  public function setSize(Size $size);

  /**
   * Returns the dimensions of the component (in pixels)
   * 
   * @return Size object containing the dimensions of the component (in pixels)
   */
  public function getSize();

  /**
   * Returns the width of the video component (in pixels)
   * 
   * @return int|null width of the component or null if not set
   */
  public function getWidth();

  /**
   * Sets the width of the component (in pixels)
   * 
   * @param  int $width the width of the component (in pixels)
   * @return self for PHP Method Chaining
   */
  public function setWidth($width);

  /**
   * Returns the height of the video component (in pixels)
   * 
   * @return int|null height of the component or null if not set
   */
  public function getHeight();

  /**
   * Sets the height of the component (in pixels)
   * 
   * @param  int $height the height of the component (in pixels)
   * @return self for PHP Method Chaining
   */
  public function setHeight($height);
}
