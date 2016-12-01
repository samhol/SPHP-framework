<?php

/**
 * InputWrapperTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Inputs\InputInterface;

/**
 * Trait implements the {@link InputInterface} and acts as a wrapper for {@link InputInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait InputWrapperTrait {

  /**
   * Returns the actual input component
   * 
   * @return InputInterface the actual input component
   */
  abstract public function getInput();

  public function disable($disabled = true) {
    $this->getInput()->disable($disabled);
    return $this;
  }

  public function isEnabled() {
    return $this->getInput()->isEnabled();
  }

  public function getName() {
    return $this->getInput()->getName();
  }

  public function setName($name) {
    $this->getInput()->setName($name);
    return $this;
  }

  public function isNamed() {
    return $this->getInput()->isNamed();
  }

  public function getValue() {
    return $this->getInput()->getSubmitValue();
  }

  public function setValue($value) {
    $this->getInput()->setValue($value);
    return $this;
  }

}
