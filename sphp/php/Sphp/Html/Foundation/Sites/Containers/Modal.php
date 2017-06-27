<?php

/**
 * Modal.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\ContentInterface;
use Sphp\Html\Foundation\Sites\Core\ClosableInterface;
use Sphp\Html\ComponentInterface;

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
class Modal implements ContentInterface, ClosableInterface {

  use \Sphp\Html\ContentTrait;

  /**
   * the Modal reveal controller
   *
   * @var ComponentInterface
   */
  private $trigger;

  /**
   * @var Popup
   */
  private $popup;

  /**
   * CSS classes corresponding to the size constants
   *
   * @var string[]
   */
  private static $sizes = [
      'tiny', 'small', 'large', 'full'
  ];

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class
   * that implements magic method `__toString()` is allowed.
   * 
   * @param ComponentInterface|string $trigger
   * @param mixed $popup the content of the component
   */
  public function __construct($trigger, $popup = null) {
    if (!$popup instanceof Popup) {
      $popup = new Popup($popup);
    }
    $this->popup = $popup;
    $this->popup->identify('id', 'modal_');
    $this->popup->cssClasses()->lock('reveal');
    $this->popup->attrs()->demand('data-reveal');
    $this->trigger = $this->createController($trigger);
  }

  public function getTrigger(): ComponentInterface {
    return $this->trigger;
  }

  public function getPopup(): Popup {
    return $this->popup;
  }

  public function setTrigger(ComponentInterface $trigger) {
    $this->trigger = $trigger;
    return $this;
  }

  public function setPopup(Popup $popup) {
    $this->popup = $popup;
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
    $this->resetSize();
    $this->popup->cssClasses()->add($size);
    return $this;
  }

  /**
   * Resets the size settings of the component
   *
   * @return self for a fluent interface
   */
  public function resetSize() {
    $this->popup->cssClasses()
            ->remove(static::$sizes);
    return $this;
  }

  /**
   * Returns the default Modal reveal controller
   * 
   * @return Controller
   */
  public function getDefaultController() {
    return $this->trigger;
  }

  public function getHtml(): string {
    return $this->trigger->getHtml() . $this->popup->getHtml();
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
   * @param  mixed $content the controller component
   * @return ComponentInterface a controller component pointing to this Modal
   */
  public function createController($content) {
    if (!$content instanceof ComponentInterface) {
      $content = new \Sphp\Html\Span($content);
    }
    return $this->popup->createController($content);
  }

  public function isClosable(): bool {
    return $this->popup->isClosable();
  }

  public function setClosable(bool $closable = true) {
    $this->popup->setClosable($closable);
    return $this;
  }

}
