<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\ValidableInput;

/**
 * Description of ValidableInputContainerTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait ValidableInputContainerTrait {

  /**
   * 
   */
  abstract public function getInput(): ValidableInput;

  public function disable(bool $disabled = true) {
    $this->getInput()->disable($disabled);
    return $this;
  }

  public function getName(): ?string {
    return $this->getInput()->getName();
  }

  public function getSubmitValue() {
    return $this->getInput()->getSubmitValue();
  }

  public function isEnabled(): bool {
    return $this->getInput()->isEnabled();
  }

  public function isNamed(): bool {
    return $this->getInput()->isNamed();
  }

  public function isRequired(): bool {
    return $this->getInput()->isRequired();
  }

  public function setInitialValue($value) {
    $this->getInput()->setInitialValue($value);
    return $this;
  }

  public function setName(string $name = null) {
    $this->getInput()->setName($name);
    return $this;
  }

  public function setRequired(bool $required = true) {
    $this->getInput()->setRequired($required);
    return $this;
  }

}
