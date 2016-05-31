<?php

/**
 * ButtonTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

/**
 * Trait implements {@link ButtonStylingInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait SizingTrait {

  /**
   * CSS classes corresponding to the size constants
   *
   * @var string[]
   */
  private $sizes = [
      "tiny", "small", "large", "expand"
  ];

  /**
   * Sets the size of the button 
   * 
   * Predefined values of <var>$size</var> parameter:
   * 
   * * `'tiny'` for tiny buttons
   * * `'small'` for small buttons
   * * `null` for "medium" (default) buttons
   * * `'large'` for large buttons
   * * `'extend'` for extended buttons (takes the full width of the container)
   * 
   * @param  string|null $size optional CSS class name defining button size. 
   *         `null` value corresponds to no explicit size definition.
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setSize($size = null) {
    $sizes = [
        "tiny", "small", "large", "expand"
    ];
    $this->removeCssClass($sizes);
    if ($size !== null) {
      $this->addCssClass($size);
      if (!in_array($size, $this->sizes)) {
        $this->sizes[] = $size;
      }
    }
    return $this;
  }

  /**
   * Sets the button size as ´'tiny'´ 
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setTiny() {
    return $this->setSize("tiny");
  }

  /**
   * Sets the button size as ´'small'´ 
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setSmall() {
    return $this->setSize("small");
  }

  /**
   * Sets the button size to default
   * 
   *  Removes all specified size related CSS classes
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setDefaultSize() {
    return $this->setSize("medium");
  }

  /**
   * Sets the button size as ´'large'´ 
   * 
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setLarge() {
    return $this->setSize("large");
  }

}
