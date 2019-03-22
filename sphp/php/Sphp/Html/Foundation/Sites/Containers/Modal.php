<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\AbstractContent;
use Sphp\Html\Foundation\Sites\Core\ClosableInterface;
use Sphp\Html\Component;

/**
 * Implements Reveal Modal 
 * 
 * Modal dialogs, or pop-up windows, are handy for prototyping and production.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 
 * @link    http://foundation.zurb.com/sites/docs/reveal.html Foundation Reveal
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Modal extends AbstractContent implements ClosableInterface {

  /**
   * the Modal reveal controller
   *
   * @var Component
   */
  private $trigger;

  /**
   * @var Popup
   */
  private $popup;

  /**
   * Constructor
   *
   * @param Component|string $trigger
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
   * @return Component the opener component
   */
  public function getTrigger(): Component {
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
   * @param  Component $trigger the opener component
   * @return $this for a fluent interface
   */
  public function setTrigger(Component $trigger) {
    $this->trigger = $trigger;
    return $this;
  }

  /**
   * Sets the popup component
   * 
   * @param  Popup $popup the popup component
   * @return $this for a fluent interface
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
   * @return Component a controller component pointing to this Modal
   */
  public function createController($content) {
    if (!$content instanceof Component) {
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

  public function useOverLay(bool $use = true) {
    if ($use) {
      $this->getPopup()->removeAttribute('data-overlay');
    } else {
      $this->getPopup()->setAttribute('data-overlay', 'false');
    }
    return $this;
  }

}
