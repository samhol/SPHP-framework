<?php

/**
 * Controller.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Modals;

use Sphp\Html\ContainerTag;

/**
 * Implements Foundation Reveal Modal controller
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
class Controller extends ContainerTag {

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
    parent::__construct('a', $content);
    $this->attrs()->demand('data-open');
    $this->setTarget($modal);
  }

  /**
   * 
   * @param  Modal $modal
   * @return self for PHP Method Chaining
   */
  private function setTarget(Modal $modal) {
    //var_dump($modal->identify("id", "modal_"));
    $this->attrs()->set('data-open', $modal->identify('id', 'modal_'));
    $this->modal = $modal;
    return $this;
  }

}
