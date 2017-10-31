<?php

/**
 * TextualInputWrapperTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Trait implements Textual input properties
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait TextualInputWrapperTrait {

  /**
   * Returns the actual input component
   * 
   * @return TextualInputInterface the actual input component
   */
  abstract public function getInput();

  public function autocomplete(bool $allow = true) {
    $this->getInput()->autoComplete($allow);
    return $this;
  }

  public function getMaxlength() {
    return $this->getInput()->getMaxlength();
  }

  public function getValidationPattern() {
    return $this->getInput()->getValidationPattern();
  }

  public function hasValidationPattern() {
    return $this->getInput()->hasValidationPattern();
  }

  public function setMaxlength($maxlength) {
    $this->getInput()->setMaxlength($maxlength);
    return $this;
  }

  public function setPlaceholder($placeholder) {
    $this->getInput()->setPlaceholder($placeholder);
    return $this;
  }

  public function setSize($size) {
    $this->getInput()->setSize($size);
    return $this;
  }

  public function getPattern() {
    return $this->getInput()->getPattern();
  }

  public function hasPattern(): bool {
    return $this->getInput()->hasPattern();
  }

  /**
   * {@inheritdoc}
   * @see TextualInputInterface
   */
  public function isRequired(): bool {
    return $this->getInput()->isRequired();
  }

  public function setPattern(string $pattern) {
    $this->getInput()->setPattern($pattern);
    return $this;
  }

  public function setRequired(bool $required = true) {
    $this->getInput()->setRequired($required);
    return $this;
  }

}

