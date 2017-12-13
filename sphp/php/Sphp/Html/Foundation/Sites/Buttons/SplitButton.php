<?php

/**
 * SplitButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractComponent;

/**
 * Implements a Split Button 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/button-group.html#split-buttons Foundation 6 Split Button 
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SplitButton extends AbstractComponent {

  use \Sphp\Html\Foundation\Sites\Core\ColourableTrait;

  /**
   * CSS classes corresponding to the size constants
   *
   * @var string[]
   */
  private $sizes = [
      'tiny', 'small', 'large', 'expand'
  ];

  /**
   * the primary button
   *
   * @var ButtonInterface 
   */
  private $primary;

  /**
   * the secondary button
   *
   * @var ButtonInterface 
   */
  private $secondary;

  /**
   * Constructs a new instance
   * 
   * @param null|mixed|ButtonInterface $primary
   * @param ArrowOnlyButton $secondary
   */
  public function __construct($primary = null, ArrowOnlyButton $secondary = null) {
    parent::__construct('div');
    $this->cssClasses()->protect('button-group');
    if (!($primary instanceof ButtonInterface)) {
      $primary = ButtonStyleAdapter::create($primary);
    }
    $this->primary = $primary;
    if ($secondary === null) {
      $secondary = new ArrowOnlyButton($secondary);
    }
    $this->secondary = $secondary;
  }

  public function __destruct() {
    unset($this->primary, $this->secondary);
    parent::__destruct();
  }

  /**
   * Returns the primary button
   * 
   * @return ButtonInterface the primary button
   */
  public function primaryButton() {
    return $this->primary;
  }

  /**
   * Returns the secondary button
   * 
   * @return ButtonInterface the secondary button
   */
  public function secondaryButton() {
    return $this->secondary;
  }

  /**
   * Sets the size of the button 
   * 
   * Predefined values of `$size` parameter:
   * 
   * * `'tiny'` for tiny buttons
   * * `'small'` for small buttons
   * * `'medium'` for "medium" (default) buttons
   * * `'large'` for large buttons
   * * `'extend'` for extended buttons (takes the full width of the container)
   * 
   * @param  string $size optional CSS class name defining button size. 
   *         `medium` value corresponds to no explicit size definition.
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setSize($size = null) {
    $this->cssClasses()->remove($this->sizes);
    if ($size !== null) {
      $this->cssClasses()->add($size);
      if (!in_array($size, $this->sizes)) {
        $this->sizes[] = $size;
      }
    }
    return $this;
  }

  /**
   * Sets the button size to default
   * 
   *  Removes all specified size related CSS classes
   * 
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setDefaultSize() {
    return $this->setSize('medium');
  }

  public function contentToString(): string {
    return $this->primary . $this->secondary;
  }

}
