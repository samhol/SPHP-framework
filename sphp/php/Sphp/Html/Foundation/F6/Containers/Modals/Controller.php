<?php

/**
 * ModalReveal.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Modals;

use Sphp\Html\ContainerTag as ContainerTag;
use Sphp\Html\Navigation\HyperlinkInterface as HyperlinkInterface;

/**
 * Class implements Foundation Reveal Modal 
 * 
 * Modal dialogs, or pop-up windows, are handy for prototyping and production.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-25
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/docs/components/reveal.html Founfation Reveal
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Controller extends ContainerTag implements \Sphp\Html\Attributes\AttributeChangeObserver {

  /**
   * the Modal reveal controller
   *
   * @var HyperlinkInterface
   */
  private $modal;

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
   * @param ModalReveal $modal
   */
  public function __construct($content = null, ModalReveal $modal) {
    parent::__construct("a", $content);
    $this->attrs()->demand("data-open");
    $this->setTarget($modal);
  }

  private function setTarget(ModalReveal $modal) {
    //$modal->
    $this->modal = $modal;
    $this->attrs()->set("data-open", $modal->getId());
    $modal->attachAttributeChangeObserver($this);
    return $this;
  }

  public function attributeChanged(\Sphp\Html\Attributes\AttributeChanger $obj, $attrName) {
    if ($attrName == "id") {
      $this->attrs()->set("data-open", $this->modal->getId());
    }
  }

}
