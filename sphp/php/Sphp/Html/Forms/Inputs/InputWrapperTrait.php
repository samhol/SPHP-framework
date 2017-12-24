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

  public function disable(bool $disabled = true) {
    $this->getInput()->disable($disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return $this->getInput()->isEnabled();
  }

  public function getName() {
    return $this->getInput()->getName();
  }

  public function setName(string $name = null) {
    $this->getInput()->setName($name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->getInput()->isNamed();
  }

  public function getValue() {
    return $this->getInput()->getSubmitValue();
  }

  public function setValue($value) {
    $this->getInput()->setSubmitValue($value);
    return $this;
  }

}
