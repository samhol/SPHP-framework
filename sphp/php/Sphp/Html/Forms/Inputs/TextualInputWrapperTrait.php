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
 * @since   2014-03-02
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

  public function autocomplete($allow = true) {
    $this->getInput()->autoComplete($allow);
    return $this;
  }

  public function getMaxlength() {
    return $this->getInput()->getMaxlength();
  }

  public function getSize() {
    return $this->getInput()->getSize();
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

  public function hasPattern() {
    return $this->getInput()->hasPattern();
  }

  /**
   * {@inheritdoc}
   * @see TextualInputInterface
   */
  public function isRequired() {
    return $this->getInput()->isRequired();
  }

  public function setPattern($pattern) {
    $this->getInput()->setPattern($pattern);
    return $this;
  }

  public function setRequired($required = true) {
    $this->getInput()->setRequired($required);
    return $this;
  }

}
