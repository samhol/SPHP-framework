<?php

namespace Sphp\Html\Qtip;

use Sphp\Html\ComponentInterface;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QtipTrait
 *
 * @author Sami Holck
 */
class Qtippable implements ComponentInterface {

  use \Sphp\Html\IdentifiableComponentTrait;

  /**
   *
   * @var ComponentInterface
   */
  private $component;

  public function __construct(ComponentInterface $component, $qtip = null) {
    $this->component = $component;
    if ($qtip !== null) {
      $this->setQtip($qtip);
    }
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->component);
  }

  /**
   * 
   * @return ComponentInterface
   */
  public function getComponent() {
    return $this->component;
  }

  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $qtip the value of the title attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setQtip($qtip) {
    $this->attrs()
            ->set("title", $qtip)
            ->set("data-sphp-qtip", true);
    return $this;
  }

  /**
   * Sets the value of the title attribute
   *
   * @param  string $my
   * @param  string $at
   * @return self for PHP Method Chaining
   */
  public function setQtipPosition($my, $at) {
    $this->attrs()
            ->set("data-sphp-qtip", true)
            ->set("data-sphp-qtip-at", $at)
            ->set("data-sphp-qtip-my", $my);
    return $this;
  }

  public function getHtml() {
    return $this->component->getHtml();
  }

  public function attrs() {
    return $this->component->attrs();
  }

}
