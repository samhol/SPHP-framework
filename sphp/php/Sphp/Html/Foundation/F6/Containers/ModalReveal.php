<?php

/**
 * ModalReveal.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers;

use Sphp\Html\ContainerTag as ContainerTag;
use Sphp\Html\Navigation\HyperlinkInterface as HyperlinkInterface;
use Sphp\Html\Navigation\Hyperlink as Hyperlink;

/**
 * Class implements Foundation Reveal Modal 
 * 
 * Modal dialogs, or pop-up windows, are handy for prototyping and production.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-25
 * @version 1.0.1
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/reveal.html Founfation Reveal
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ModalReveal extends ContainerTag {

  /**
   * the Modal reveal controller
   *
   * @var HyperlinkInterface
   */
  private $modalController;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class
   * that implements magic method `__toString()` is allowed.
   *
   * @param mixed $content the content of the component
   * @param mixed $controller
   */
  public function __construct($content = null) {
    parent::__construct("div", $content);
    $this->identify();
    $this->cssClasses()->lock("reveal-modal");
    $this->attrs()->lock("data-reveal", "");
  }

  /**
   * Sets the size of the component
   *
   * **Available size options:**
   * 
   * * `'tiny'`: set the width to 30%
   * * `'small'`: set the width to 40%
   * * `'medium'`: set the width to 60%
   * * `'large'`: set the width to 70%
   * * `'xlarge'`: set the width to 90%
   * * `'full'`: set the width and height to 100%
   * 
   * **Note:** Default on `'small'` screens is 100% (`'full'`) width.
   * 
   * @param  string $size the size of the component
   * @return self for PHP Method Chaining
   */
  public function setSize($size) {
    return $this->resetSize()
                    ->addCssClass($size);
  }

  /**
   * Resets the size settings of the component
   *
   * @return self for PHP Method Chaining
   */
  public function resetSize() {
    return $this->removeCssClass(["tiny", "small", "medium", "large", "xlarge", "full"]);
  }

  /**
   * Returns the Modal reveal controller
   * 
   * @return HyperlinkInterface
   */
  public function getController() {
    return $this->modalController;
  }

  /**
   * {@inheritdoc}
   */
  public function getHtml() {
    return $this->modalController . parent::getHtml();
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
   * @param  mixed|HyperlinkInterface $controller the controller component
   * @return HyperlinkInterface a link component pointing to this Modal
   */
  public function createController($controller) {
    if (!($controller instanceof HyperlinkInterface)) {
      $controller = new Hyperlink("#", $controller);
    }
    $controller->setHref("#")
            ->setAttr("data-reveal-id", $this->getId())
            ->setAttr("data-reveal");
    return $controller;
  }

  public function createCloseButton() {
    return '<a class="close-reveal-modal" aria-label="Close">&#215;</a>';
  }

}
