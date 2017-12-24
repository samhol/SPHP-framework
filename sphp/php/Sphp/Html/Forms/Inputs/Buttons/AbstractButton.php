<?php

/**
 * SubmitButton.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 */

namespace Sphp\Html\Forms\Inputs\Buttons;

use Sphp\Html\EmptyTag;
use Sphp\Html\Forms\Buttons\ButtonInterface;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Strings;

/**
 * Implements &lt;input type="button|submit|reset"&gt; button tag
 *
 * A submit button is used to send form data to a server.
 * The data is sent to the page specified in the form's action attribute.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractButton extends EmptyTag implements ButtonInterface {

  /**
   * Constructs a new instance
   *
   * @param  string $type the type of the button
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   * @throws Sphp\Exceptions\InvalidArgumentException if the type parameter is invalid
   */
  public function __construct(string $type, string $content = null) {
    if (!Strings::match($type, "/^(submit|reset|button|image)$/")) {
      throw new InvalidArgumentException("Illegal form button type '$type'");
    }
    parent::__construct('input');
    $this->attrs()->protect('type', $type);
    if ($content !== null) {
      $this->setContent($content);
    }
  }

  /**
   * Sets the content of the button
   * 
   * @param  string $content the content of the button
   * @return $this for a fluent interface
   */
  public function setContent(string $content) {
    $this->attrs()->set('value', $content);
    return $this;
  }

}
