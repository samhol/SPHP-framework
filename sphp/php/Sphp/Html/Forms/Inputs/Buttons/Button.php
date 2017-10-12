<?php

/**
 * ButtonTag.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Buttons;


/**
 * Implements an HTML &lt;button type="button"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_button.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-button-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Button extends AbstractButton {

  /**
   * Constructs a new instance
   *
   * @param  mixed $content the content of the button tag
   */
  public function __construct($content = null) {
    parent::__construct('button', $content);
  }

}
