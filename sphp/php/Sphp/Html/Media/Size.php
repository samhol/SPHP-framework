<?php

/**
 * Size.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

/**
 * Class models a size object for defining the dimensions of the {@link SizeableInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-02-15
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Size {

  /**
   * the width
   *
   * @var int|boolean
   */
  private $width = false;

  /**
   * the height
   *
   * @var int|boolean
   */
  private $height = false;

  /**
   * Constructs a new instance
   * 
   * **Note:** `boolean false` represents an unset value
   *
   * @param int|boolean $width optional width in pixels: false if the width is not set
   * @param int|boolean $height optional height in pixels: false if the height is not set
   */
  public function __construct($width = false, $height = false) {
    $parseDimension = function ($dim) {
      if ($dim !== false) {
        $result = (int) $dim;
      } else {
        $result = false;
      }
      return $result;
    };
    $this->width = $parseDimension($width);
    $this->height = $parseDimension($height);
  }

  /**
   * Returns the width
   * 
   * **Note:** `boolean false` represents an unset value
   * 
   * @return int|boolean width or false if the height is not set
   */
  public function getWidth() {
    return $this->width;
  }

  /**
   * Checks whether the width is set or not
   * 
   * @return boolean true if the width is set, and false if not
   */
  public function hasWidth() {
    return $this->getWidth() !== false;
  }

  /**
   * Returns the height
   * 
   * **Note:** `boolean false` represents an unset value
   * 
   * @return int|boolean height or false if the height is not set
   */
  public function getHeight() {
    return $this->height;
  }

  /**
   * Checks whether the height is set or not
   * 
   * @return boolean true if the height is set, and false if not
   */
  public function hasHeight() {
    return $this->getHeight() !== false;
  }

  public function __toString() {
    return sprintf('%dx%d px', $this->width, $this->height);
  }

  public function toArray() {
    return get_object_vars($this);
  }

}
