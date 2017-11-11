<?php

/**
 * ColourableAdapter.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Adapters\AbstractComponentAdapter;
use Sphp\Html\CssClassifiedComponent;
use Sphp\Stdlib\Arrays;

/**
 * Trait implements {@link ColourableInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ColourableAdapter extends AbstractLayoutManager implements ColourableInterface {

  /**
   * CSS classes corresponding to the button style constants
   *
   * @var string[]
   */
  private static $styles = [
      'alert', 'success', 'secondary', 'info', 'disabled'
  ];

  /**
   * Constructs a new instance
   * 
   * @param CssClassifiedComponent $component
   */
  public function __construct(CssClassifiedComponent $component) {
    parent::__construct($component);
  }

  /**
   * Sets the color (a CSS class)
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
   * @param  string|null $style one of the CSS class names defining button styles
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Sizing
   */
  public function setColor(string $style = null) {
    $this->setOneOf(static::$styles, $style);
    return $this;
  }

  public function setLayouts(...$layouts) {
    $colors = array_intersect(Arrays::flatten($layouts), static::$styles);
    foreach ($colors as $colorCandidate) {
      $this->setColor($value);
    }
  }

  public function unsetLayouts(): \this {
    
  }

}
