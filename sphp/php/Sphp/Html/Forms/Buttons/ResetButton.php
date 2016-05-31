<?php

/**
 * ResetButton.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Buttons;

/**
 * Class Models an HTML &lt;button type="reset"&gt; tag
 *
 *
 * {@inheritdoc}
 *
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since  2012-08-22
 * @link    http://www.w3schools.com/tags/tag_button.asp w3schools API link
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-button-element W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 *
 */
class ResetButton extends Button {

  /**
   * Constructor
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a string or an array of strings.
   * So also an object of any class that implements magic method `__toString()` is allowed.
   *
   * @param  mixed|null $content the content of the button tag
   * @param  string|null $name the value of name attribute
   * @param  string|null $value the value of value attribute
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null, $name = null, $value = null) {
    parent::__construct("reset", $content, $name, $value);
  }

}
