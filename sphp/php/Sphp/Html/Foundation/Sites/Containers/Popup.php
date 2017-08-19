<?php

/**
 * Reveal.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\ComponentInterface;
use Sphp\Html\Div;
use Sphp\Html\Foundation\Sites\Buttons\CloseButton;

/**
 * Implements Reveal Modal 
 * 
 * Modal dialogs, or pop-up windows, are handy for prototyping and production.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-25
 * @link    http://foundation.zurb.com/ Foundation 
 * @link    http://foundation.zurb.com/sites/docs/reveal.html Founfation Reveal
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Popup extends Div {

  /**
   * @var CloseButton
   */
  private $closeButton;

  /**
   * @var PopupLayoutManager 
   */
  private $layoutManager;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class
   * that implements magic method `__toString()` is allowed.
   * 
   * @param  mixed|null $content added content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->identify('id', 'modal_');
    $this->cssClasses()->lock('reveal');
    $this->attrs()->demand('data-reveal');
    $this->closeButton = new CloseButton();
    $this->layoutManager = new PopupLayoutManager($this);
  }

  public function layout(): PopupLayoutManager {
    return $this->layoutManager;
  }

  /**
   * Returns the Modal reveal controller
   * 
   * @return CloseButton
   */
  public function getCloseButton() {
    return $this->closeButton;
  }

  /**
   * Returns the Modal reveal controller
   * 
   * @return self for a fluent interface
   */
  public function setCloseButton(CloseButton $btn) {
    $this->closeButton = $btn;
    return $this;
  }

  /**
   * Sets the size of the component
   *
   * **Available size options:**
   * 
   * * `'tiny'`: set the width to 30%
   * * `'small'`: set the width to 50%
   * * `'large'`: set the width to 90%
   * * `'full'`: set the width and height to 100%
   * 
   * **Note:** Default on `'small'` screens is 100% (`'full'`) width.
   * 
   * @param  string $size the size of the component
   * @return self for a fluent interface
   */
  public function setSize($size) {
    $this->layout()->setSize($size);
    return $this;
  }

  /**
   * Resets the size settings of the component
   *
   * @return self for a fluent interface
   */
  public function resetSize() {
    $this->layout()->unsetSizing();
    return $this;
  }

  /**
   * Returns the default Modal reveal controller
   * 
   * @return Controller
   */
  public function getDefaultController() {
    return $this->modalController;
  }

  public function contentToString(): string {
    $output = parent::contentToString();

    $output .= $this->getCloseButton()->getHtml();

    return $output;
  }

  /**
   * Returns a link component pointing to the Modal component
   *
   * **Important!**
   *
   * Parameter `mixed $controller` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class
   * that implements magic method `__toString()` is allowed.
   *
   * @param  ComponentInterface $content the controller component
   * @return ComponentInterface a controller component pointing to this Modal
   */
  public function createController(ComponentInterface $content): ComponentInterface {
    $content->setAttr('data-open', $this->identify());
    return $content;
  }

}
