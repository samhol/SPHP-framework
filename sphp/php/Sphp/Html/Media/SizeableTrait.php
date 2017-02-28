<?php

/**
 * SizeableTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

/**
 * Trait implements the {@link SizeableInterface} interface for a {@link \Sphp\Html\ComponentInterface}
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-15
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait SizeableTrait {

  /**
   * Sets the dimensions of the component (in pixels)
   * 
   * @param  Size $size object containing the dimension settings
   * @return self for a fluent interface
   */
  public function setSize(Size $size) {
    $this
            ->setWidth($size->getWidth())
            ->setHeight($size->getHeight());
    return $this;
  }

  /**
   * Returns the dimensions of the component (in pixels)
   * 
   * @return Size new object containing the dimension settings
   */
  public function getSize() {
    return new Size($this->getWidth(), $this->getHeight());
  }

  /**
   * Returns the width of the video component (in pixels)
   * 
   * @return int|boolean width of the component or `false` if not set
   */
  public function getWidth() {
    return $this->parseDimension($this->attrs()->get('width'));
  }

  /**
   * Sets the width of the component (in pixels)
   * 
   * @param  int|boolean $width the width of the component (in pixels)), false 
   *         to unset
   * @return self for a fluent interface
   */
  public function setWidth($width) {
    $this->attrs()->set('width', $this->parseDimension($width));
    return $this;
  }

  /**
   * Returns the height of the video component (in pixels)
   * 
   * @return int|boolean height of the component or `false` if not set
   */
  public function getHeight() {
    return $this->parseDimension($this->attrs()->get('height'));
  }

  /**
   * Sets the height of the component (in pixels)
   * 
   * @param  int|boolean $height the height of the component (in pixels), `false` 
   *         to unset
   * @return self for a fluent interface
   */
  public function setHeight($height) {
    $this->attrs()->set('height', $this->parseDimension($height));
    return $this;
  }

  /**
   * Parses the given input
   * 
   * @param  int|boolean $dim the dimension to parse of the component (in pixels)
   * @return int|boolean
   */
  private function parseDimension($dim) {
    if ($dim !== false) {
      return (int) $dim;
    } else {
      return $dim;
    }
  }

}
