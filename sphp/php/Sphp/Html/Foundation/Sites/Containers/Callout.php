<?php

/**
 * Callout.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

/**
 * Implements a callout component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation Callout
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Callout extends ClosableContainer implements CalloutInterface {

  /**
   * @var CalloutLayoutManager 
   */
  private $layoutManager;

  /**
   * Constructs a new instance
   *
   * @param  mixed|null $content added content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->protect('callout');
    $this->layoutManager = new CalloutLayoutManager($this);
  }

  public function layout() {
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
