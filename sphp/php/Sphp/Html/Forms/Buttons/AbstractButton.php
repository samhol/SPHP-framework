<?php

/**
 * AbstractButton.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\ContainerTag;
use Sphp\Stdlib\Strings;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * An abstract implementation of an HTML &lt;button type="submit|reset|button|image"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_button.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-button-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractButton extends ContainerTag implements ButtonInterface {

  /**
   * Constructs a new instance
   *
   * @param string $tagname the tag name of the component
   * @param string $type button type (the value of type attribute)
   * @param string|null $content the content of the button
   */
  public function __construct(string $tagname, string $type, $content = null) {
    if (!Strings::match($type, "/^(submit|reset|button|image)$/")) {
      throw new InvalidArgumentException("Illegal form button type '$type'");
    }
    parent::__construct($tagname, $content);
    $this->attributes()->protect('type', $type);
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->setBoolean('disabled', $disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->exists('disabled');
  }

}
