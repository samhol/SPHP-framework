<?php

/**
 * AbstractButton.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;button&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-02-06
 * @link    http://www.w3schools.com/tags/tag_button.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-button-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractButton extends ContainerTag {

  /**
   * Constructs a new instance
   *
   * @param  string $type the value of type attribute
   * @param  string|null $content the content of the button
   */
  public function __construct($type, $content = null) {
    parent::__construct('button', $content);
    $this->attrs()->lock('type', $type);
  }

}
