<?php

/**
 * ContentCopyController.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\ContentInterface;
use Sphp\Html\ComponentInterface;

/**
 * Class models an action controller that copies content from the target component to the user's clipboard
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
class ContentCopyController implements ContentInterface {

  use \Sphp\Html\ContentTrait;

  private $target;

  /**
   *
   * @var ComponentInterface 
   */
  private $button;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a
   * string. So also an object of any class that implements magic method
   * `__toString()` is allowed.
   *
   * @param  mixed|mixed[] $button the copier component
   * @param  ComponentInterface|string $target the component or the id
   *         attribute of the target container
   * @link   http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function __construct(ComponentInterface $button, $target = '') {
    $this->button = $button;
    $this->setCopyTarget($target);
  }

  /**
   * 
   * @return ComponentInterface
   */
  public function getController() {
    return $this->button;
  }

  /**
   * 
   * @param  ComponentInterface $target
   * @return self for PHP Method Chaining
   */
  public function setCopyTarget($target) {
    if ($target !== $this->target) {
      if ($target instanceof ComponentInterface) {
        $id = $target->identify('id', 'copy_target', 32);
      } else {
        $id = $target;
      }
      $this->target = $target;
      $this->button->setAttr('data-clipboard-target', $id);
    }
    return $this;
  }

  public function getHtml() {
    return $this->button->getHtml();
  }

}
