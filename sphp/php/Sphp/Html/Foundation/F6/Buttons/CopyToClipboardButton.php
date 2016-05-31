<?php

/**
 * CopyToClipboardButton.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\Apps\ContentCopyController as CopyToClipboardButton;
use Sphp\Html\ComponentInterface as ComponentInterface;
use Sphp\Html\Attributes\AttributeChanger as AttributeChanger;

/**
 * Class models an action button that copies content from the target component to the user's clipboard
 *
 * Component uses The ZeroClipboard library as its backbone.
 *
 * The ZeroClipboard library provides an easy way to copy text to the clipboard
 * using an invisible Adobe Flash movie and a JavaScript interface.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-13
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CopyToClipboardButton extends CopyToClipboardButton implements ButtonInterface {

  use ButtonStylingTrait;
  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a
   * string. So also an object of any class that implements magic method
   * `__toString()` is allowed.
   *
   * @param  ComponentInterface|string $target the component or the id
   *         attribute of the target container
   * @param  mixed|mixed[] $content the content of the button
   * @link   http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function __construct($target = "") {
    parent::__construct($target);
    $this->content()->append($content);
  }

}
