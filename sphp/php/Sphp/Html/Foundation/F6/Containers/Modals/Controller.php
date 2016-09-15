<?php

/**
 * ModalReveal.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Modals;

use Sphp\Html\ContainerTag as ContainerTag;
use Sphp\Html\Attributes\IdentityObserver as IdentityObserver;
use Sphp\Html\Attributes\IdentityChanger as IdentityChanger;

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
class Controller extends ContainerTag implements IdentityChanger {

  /**
   * the Modal reveal controller
   *
   * @var Modal
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
   * @param Modal $modal
   * @param mixed $content the content of the component
   */
  public function __construct(Modal $modal, $content = null) {
    parent::__construct("a", $content);
    $this->attrs()->demand("data-open");
    $this->setTarget($modal);
  }

  /**
   * 
   * @param \Sphp\Html\Foundation\F6\Containers\Modals\Modal $modal
   * @return \Sphp\Html\Foundation\F6\Containers\Modals\Controller
   */
  private function setTarget(Modal $modal) {
    $this->attrs()->set("data-open", $modal->getId());
    $modal->attachIdentityObserver($this, "id");
    if ($this->modal !== null) {
      $this->modal->detachIdentityObserver($this, "id");
    }
    $this->modal = $modal;
    return $this;
  }


  /**
   * {@inheritdoc}
   */
  public function identityChanged(AttributeChanger $obj, $attrName) {
    if ($attrName == "id") {
      $this->attrs()->set("data-open", $this->modal->getId());
    }
  }

}
