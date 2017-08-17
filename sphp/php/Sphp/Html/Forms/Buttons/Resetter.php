<?php

/**
 * ResetButton.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\Forms\ResetterInterface;

/**
 * Implements an HTML &lt;input type="reset"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since  2012-08-22
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Resetter extends AbstractButton implements ResetterInterface {

  /**
   * Constructs a new instance
   *
   * @param  string|null $content the content of the button
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct($content = null) {
    parent::__construct('reset', $content);
  }

}
