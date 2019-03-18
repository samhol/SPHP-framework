<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Inputs\Input;

/**
 * Trait implements the {@link InputInterface} and acts as a wrapper for {@link InputInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait InputWrapperTrait {

  /**
   * Returns the actual input component
   * 
   * @return Input the actual input component
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
    $this->getInput()->setInitialValue($value);
    return $this;
  }

}
