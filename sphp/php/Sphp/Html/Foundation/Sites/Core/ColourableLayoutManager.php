<?php

/**
 * ColourableLayoutManager.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\AbstractLayoutManager;
use Sphp\Html\ComponentInterface;

/**
 * Trait implements {@link ColourableInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ColourableLayoutManager extends AbstractLayoutManager implements ColourableInterface {

  /**
   * CSS classes corresponding to the colors
   *
   * @var string[]
   */
  private $colors = [
      'alert', 'success', 'secondary', 'info', 'disabled', 'warning'
  ];

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component) {
    parent::__construct($component);
  }

  /**
   * 
   * @param array $layouts
   */
  public function setLayouts($layouts) {
    $this->unsetColors();
    foreach (is_array($layouts) ? $layouts : [$layouts] as $layout) {
      $this->setColor($layout);
    }
    return $this;
  }

  public function unsetLayouts() {
    $this->unsetColors();
    return $this;
  }

  /**
   * Sets the color
   * 
   * Predefined values of <var>$style</var> parameter:
   * 
   * * `null` unsets all special button styles (default)
   * * `'alert'` for alert/error buttons
   * * `'success'` for ok/success buttons
   * * `'info'` for information buttons
   * * `'secondary'` for alternatively styled buttons
   * * `'disabled'` for disabled buttons
   * 
   * @param  string|null $color one of the CSS class names defining button styles
   * @return self for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Sizing
   */
  public function setColor($color = null) {
    if ($color === null) {
      $this->unsetLayouts();
    } else if (in_array($color, $this->colors)) {
      $this->unsetLayouts();
      $this->cssClasses()->add($color);
    }
    return $this;
  }


  /**
   * Unsets the color settings
   * 
   * @return self for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Sizing
   */
  public function unsetColors() {  
    $this->cssClasses()->remove($this->colors);
    return $this;
  }
}
