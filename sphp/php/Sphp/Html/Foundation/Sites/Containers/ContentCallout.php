<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers;

/**
 * Implements a Foundation Callout component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation Callout
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ContentCallout extends ClosableContainer implements Callout {

  /**
   * @var CalloutLayoutManager 
   */
  private $layoutManager;

  /**
   * Constructor
   *
   * @param  mixed|null $content added content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->protectValue('callout');
    $this->layoutManager = new CalloutLayoutManager($this);
  }

  public function layout(string ...$layouts) {
    if (!empty ($layouts)) {
      $this->layoutManager->setLayouts($layouts);
    }
    return $this->layoutManager;
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
    $this->layout()->setColor($style);
    return $this;
  }

}
