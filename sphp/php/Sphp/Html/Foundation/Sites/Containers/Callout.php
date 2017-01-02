<?php

/**
 * Callout.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Div;
use Sphp\Html\Foundation\Sites\Buttons\CloseButton;
use Sphp\Html\Foundation\Sites\Core\ColourableTrait;

/**
 * Implements a Foundation callout component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation Callout
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Callout extends Div implements CalloutInterface {

  use ColourableTrait;

  /**
   * The inner close button component
   *
   * @var CloseButton
   */
  private $closeButton;

  /**
   * Constructs a new instance
   *
   * @param  mixed|null $content added content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->lock('callout');
    $this->closeButton = new CloseButton('close');
  }

  /**
   * Sets the content padding
   * 
   * Predefined paddings:
   * 
   * * `'small'` for small padding
   * * `'default'` for (default) padding
   * * `'large'` for large padding
   * 
   * @param  string|null $padding optional CSS class name defining the amount of the content padding
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/callout.html#sizing Callout Sizing
   */
  public function setPadding($padding = 'default') {
    $paddings = ['small', 'large'];
    $this->removeCssClass($paddings);
    if (in_array($padding, $paddings)) {
      $this->addCssClass($padding);
    }
    return $this;
  }
  
  public function setClosable($closable = true) {
    $this->attrs()->set('data-closable', $closable);
    return $this;
  }

  public function isClosable() {
    return $this->attrs()->exists('data-closable');
  }

  public function contentToString() {
    $output = parent::contentToString();
    if ($this->isClosable()) {
      $output .= $this->closeButton;
    }
    return $output;
  }

}
