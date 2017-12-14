<?php

/**
 * Modal.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Content;
use Sphp\Html\Foundation\Sites\Core\ClosableInterface;
use Sphp\Html\ComponentInterface;

/**
 * Implements Reveal Modal 
 * 
 * Modal dialogs, or pop-up windows, are handy for prototyping and production.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 
 * @link    http://foundation.zurb.com/sites/docs/reveal.html Foundation Reveal
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Modal implements Content, ClosableInterface {

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
   * Constructs a new instance
   *
   * @param ComponentInterface|string $trigger
   * @param mixed $popup the content of the component
   */
  public function __construct($trigger, $popup = null) {
    if (!$popup instanceof Popup) {
      $popup = new Popup($popup);
    }
    $this->popup = $popup;
    $this->trigger = $this->createController($trigger);
  }

  /**
   * Returns the opener component
   * 
   * @return ComponentInterface the opener component
   */
  public function getTrigger(): ComponentInterface {
    return $this->trigger;
  }

  /**
   * Returns the popup component
   * 
   * @return Popup the popup component
   */
  public function getPopup(): Popup {
    return $this->popup;
  }

  /**
   * Sets the opener component
   * 
   * @param  ComponentInterface $trigger the opener component
   * @param mixed $popup the content of the component
   */
  public function setTrigger(ComponentInterface $trigger) {
    $this->trigger = $trigger;
    return $this;
  }

  /**
   * Sets the popup component
   * 
   * @param  Popup $popup the popup component
   * @param mixed $popup the content of the component
   */
  public function setPopup(Popup $popup) {
    $this->popup = $popup;
    return $this;
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
    return $this->getPopup()->isClosable();
  }

  public function setClosable($closable = true) {
    $this->getPopup()->setClosable($closable);
    return $this;
  }

}
