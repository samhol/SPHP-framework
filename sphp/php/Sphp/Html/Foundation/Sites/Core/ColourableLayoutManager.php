<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Component;

/**
 * Trait implements {@link ColourableInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ColourableLayoutManager extends AbstractLayoutManager implements Colourable {

  /**
   * CSS classes corresponding to the colors
   *
   * @var string[]
   */
  private $colors = [
      'alert', 'success', 'secondary', 'info', 'disabled', 'warning'
  ];

  /**
   * Constructor
   * 
   * @param Component $component
   */
  public function __construct(Component $component) {
    parent::__construct($component);
  }

  public function setLayouts(...$layouts) {
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
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Sizing
   */
  public function setColor(string $color = null) {
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
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Sizing
   */
  public function unsetColors() {  
    $this->cssClasses()->remove($this->colors);
    return $this;
  }
}
