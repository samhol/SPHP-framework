<?php

/**
 * TextualColumn.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Forms\Inputs;

use Sphp\Html\Forms\Inputs\InputInterface as InputInterface;
use Sphp\Html\Forms\Inputs\TextualInputInterface as TextualInputInterface;

/**
 * Class implements Foundation framework based component to create  multi-device layouts
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TextualColumn extends InputColumn implements TextualInputInterface {

  /**
   * Constructs a new instance
   *
   * @param  InputInterface $input the actual input component
   * @param  int $s column width for small screens (1-12)
   * @param  int|boolean $m column width for medium screens (1-12) or false for inheritance
   * @param  int|boolean $l column width for large screens (1-12) or false for inheritance
   * @param  int|boolean $xl column width for x-large screens (1-12) or false for inheritance
   * @param  int|boolean $xxl column width for xx-large screen)s (1-12) or false for inheritance
   */
  public function __construct(TextualInputInterface $input) {
    parent::__construct($input);
  }

  /**
   * Returns the actual input component
   * 
   * @return TextualInputInterface the actual input component
   */
  public function getInput() {
    return parent::getInput();
  }

  /**
   * {@inheritdoc}
   */
  public function autocomplete($allow = true) {
    $this->getInput()->autoComplete($allow);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getMaxlength() {
    return $this->getInput()->getMaxlength();
  }

  /**
   * {@inheritdoc}
   */
  public function getSize() {
    return $this->getInput()->getSize();
  }

  /**
   * {@inheritdoc}
   */
  public function getValidationPattern() {
    return $this->getInput()->getValidationPattern();
  }

  /**
   * {@inheritdoc}
   */
  public function hasValidationPattern() {
    return $this->getInput()->hasValidationPattern();
  }

  /**
   * {@inheritdoc}
   */
  public function setMaxlength($maxlength) {
    $this->getInput()->setMaxlength($maxlength);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setPlaceholder($placeholder) {
    $this->getInput()->setPlaceholder($placeholder);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setSize($size) {
    $this->getInput()->setSize($size);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setValidationPattern($pattern) {
    $this->getInput()->setValidationPattern($pattern);
    return $this;
  }

}
