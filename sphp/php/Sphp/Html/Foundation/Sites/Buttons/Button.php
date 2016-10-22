<?php

/**
 * HyperlinkButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\Forms\Buttons\ButtonTag as ButtonTag;

/**
 * Class implements an HTML &lt;button&gt; tag as a Foundation Button in PHP
 * 
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Button extends ButtonTag {

  /**
   * Constructs a new instance
   *
   * @param  string $type the value of type attribute
   * @param  mixed $content the content of the button tag
   * @param  string $name the value of name attribute
   * @param  string $value the value of value attribute
   * @link   http://www.w3schools.com/tags/att_button_type.asp type attribute
   * @link   http://www.w3schools.com/tags/att_button_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($type = 'button', $content = null, $name = null, $value = null) {
    parent::__construct($type, $content, $name, $value);
    $this->cssClasses()->lock('button');
  }

}
