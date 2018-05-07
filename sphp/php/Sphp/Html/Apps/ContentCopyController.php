<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps;

use Sphp\Html\Content;
use Sphp\Html\ComponentInterface;

/**
 * Implements an action controller that copies content from the target component to the user's clipboard
 *
 * Component uses The ZeroClipboard library as its backbone.
 *
 * The ZeroClipboard library provides an easy way to copy text to the clipboard
 * using an invisible Adobe Flash movie and a JavaScript interface.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ContentCopyController implements Content {

  use \Sphp\Html\ContentTrait;

  private $target;

  /**
   * @var ComponentInterface 
   */
  private $button;

  /**
   * Constructor
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
   * @return $this for a fluent interface
   */
  public function setCopyTarget($target) {
    if ($target !== $this->target) {
      if ($target instanceof ComponentInterface) {
        $id = $target->identify(32);
      } else {
        $id = $target;
      }
      $this->target = $target;
      $this->button->setAttribute('data-clipboard-target', "#$id");
      $this->button->setAttribute('data-clipboard-action', 'copy');
    }
    return $this;
  }

  public function getHtml(): string {
    return $this->button->getHtml();
  }

}
