<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Component;
use Sphp\Html\Div;
use Sphp\Html\Flow\FlowContainer;
use Sphp\Html\Foundation\Sites\Controllers\CloseButton;
use Sphp\Html\Foundation\Sites\Core\JavaScript\AbstractJavaScriptComponent;

/**
 * Implements Reveal Modal 
 * 
 * Modal dialogs, or pop-up windows, are handy for prototyping and production.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 
 * @link    http://foundation.zurb.com/sites/docs/reveal.html Founfation Reveal
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Popup extends AbstractJavaScriptComponent {

  /**
   * @var Div
   */
  private $content;

  /**
   * @var CloseButton
   */
  private $closeButton;

  /**
   * @var PopupLayoutManager 
   */
  private $layoutManager;

  /**
   * Constructor
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
    parent::__construct('div');
    $this->identify();
    $this->cssClasses()->protectValue('reveal');
    $this->attributes()->demand('data-reveal');
    $this->closeButton = new CloseButton();
    $this->layoutManager = new PopupLayoutManager($this);
    $this->content = new Div($content);
    $this->content->addCssClass('content');
  }

  public function __destruct() {
    unset($this->closeButton, $this->layoutManager, $this->content);
    parent::__destruct();
  }

  /**
   * 
   * @return FlowContainer
   */
  public function getContent(): FlowContainer {
    return $this->content;
  }

  /**
   * Returns the layout manager
   * 
   * @return PopupLayoutManager the layout manager
   */
  public function layout(): PopupLayoutManager {
    return $this->layoutManager;
  }

  /**
   * Returns the close button
   * 
   * @return CloseButton the close button
   */
  public function getCloseButton(): CloseButton {
    return $this->closeButton;
  }

  /**
   * Returns the Modal reveal controller
   * 
   * @return $this for a fluent interface
   */
  public function setCloseButton(CloseButton $btn) {
    $this->closeButton = $btn;
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
    $output = $this->content . $this->getCloseButton()->getHtml();
    return $output;
  }

  /**
   * Returns a controller component pointing to the Modal component
   *
   * @param  Component $content the controller component
   * @return Component a controller component pointing to this Modal
   */
  public function createController(Component $content): Component {
    $content->setAttribute('data-open', $this->identify());
    return $content;
  }

}
