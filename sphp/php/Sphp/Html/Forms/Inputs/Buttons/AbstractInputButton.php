<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractInputButton extends EmptyTag implements ButtonInterface {

  /**
   * Constructor
   *
   * @param  string $type the type of the button
   * @param  string|null $content the content of the button
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   * @throws Sphp\Exceptions\InvalidArgumentException if the type parameter is invalid
   */
  public function __construct(string $type, string $content = null) {
    if (!Strings::match($type, "/^(submit|reset|button|image)$/")) {
      throw new InvalidArgumentException("Illegal form button type '$type'");
    }
    parent::__construct('input');
    $this->attributes()->protect('type', $type);
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
    $this->attributes()->setAttribute('value', $content);
    return $this;
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->disabled = $disabled;
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

}
