<?php

/**
 * QtipAdapter.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Adapters;

use Sphp\Html\ComponentInterface;
use Sphp\Html\IdentifiableInterface;

/**
 * Inserts a qTip style tooltip to the adaptee
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @link    http://qtip2.com/ qTip 2
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class QtipAdapter extends AbstractComponentAdapter {

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component, $qtip = null) {
    parent::__construct($component);
    if ($qtip !== null) {
      $this->setQtip($qtip);
    }
  }

  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $qtip the value of the title attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setQtip($qtip) {
    $this->getComponent()->attrs()
            ->set('title', $qtip)
            ->set('data-sphp-qtip', true);
    return $this;
  }

  /**
   * Sets the value of the title attribute
   *
   * @param  string $my 
   * @param  string $at
   * @return $this for a fluent interface
   */
  public function setQtipPosition(string $my, string $at) {
    $this->getComponent()->attrs()
            ->set('data-sphp-qtip', true)
            ->set('data-sphp-qtip-at', $at)
            ->set('data-sphp-qtip-my', $my);
    return $this;
  }

  /**
   * 
   * @param IdentifiableInterface $viewport
   * @return $this for a fluent interface
   */
  public function setViewport($viewport) {
    if ($viewport instanceof IdentifiableInterface) {
      $id = $viewport->identify();
    }
    $this->attrs()->set('data-sphp-qtip-viewport', "#$id");
    return $this;
  }

}
