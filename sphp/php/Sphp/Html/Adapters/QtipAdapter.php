<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Adapters;

use Sphp\Html\Component;
use Sphp\Html\IdentifiableContent;

/**
 * Inserts a qTip style tooltip to the adaptee
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://qtip2.com/ qTip 2
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class QtipAdapter extends AbstractComponentAdapter {

  /**
   * Constructor
   * 
   * @param Component $component
   * @param string|null $qtip the value of the title attribute
   */
  public function __construct(Component $component, string $qtip = null) {
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
  public function setQtip(string $qtip = null) {
    $this->getComponent()->attributes()
            ->setAttribute('title', $qtip)
            ->setAttribute('data-sphp-qtip', true);
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
    $this->getComponent()->attributes()
            ->setAttribute('data-sphp-qtip', true)
            ->setAttribute('data-sphp-qtip-at', $at)
            ->setAttribute('data-sphp-qtip-my', $my);
    return $this;
  }

  /**
   * 
   * @param IdentifiableContent $viewport
   * @return $this for a fluent interface
   */
  public function setViewport($viewport) {
    if ($viewport instanceof IdentifiableContent) {
      $id = $viewport->identify();
    }
    $this->attributes()->setAttribute('data-sphp-qtip-viewport', "#$id");
    return $this;
  }

}
