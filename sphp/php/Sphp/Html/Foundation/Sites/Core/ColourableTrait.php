<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Attributes\ClassAttribute;

/**
 * Trait implements {@link ColourableInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
trait ColourableTrait {

  use LayoutAdapterTrait;

  /**
   * CSS classes corresponding to the button style constants
   *
   * @var string[]
   */
  private $styles = [
      'alert', 'success', 'secondary', 'info', 'disabled'
  ];

  /**
   * Returns the class attribute object
   * 
   * @return ClassAttribute the class attribute object
   */
  abstract public function cssClasses(): ClassAttribute;

  /**
   * Sets the color (a CSS class)
   * 
   * Predefined values of `$style` parameter:
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
    $this->cssClasses()->remove($this->styles);
    if ($style !== null) {
      $this->cssClasses()->add($style);
      if (!in_array($style, $this->styles)) {
        $this->styles[] = $style;
      }
    }
    return $this;
  }

}
