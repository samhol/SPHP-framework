<?php

/**
 * SelectMenuColumn.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Forms\Inputs;

use Sphp\Html\Forms\Inputs\Menus\SelectMenuInterface as SelectMenuInterface;
use Sphp\Html\Forms\Inputs\Menus\Select as Select;

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
class SelectMenuColumn extends InputColumn implements SelectMenuInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   *
   * @param  Select $input the actual input component
   */
  public function __construct($name = null, $opt = null, $selectedValues = null) {
    parent::__construct(new \Sphp\Html\Forms\Inputs\Menus\Select($name, $opt, $selectedValues));
  }

  /**
   * Returns the actual input component
   * 
   * @return SelectMenuInterface the actual input component
   */
  public function getInput() {
    return parent::getInput();
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
  public function isRequired() {
    return $this->getInput()->isRequired();
  }

  /**
   * {@inheritdoc}
   */
  public function setRequired($required = true) {
    $this->getInput()->setRequired($required);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    return $this->getInput()->count();
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return $this->getInput()->getIterator();
  }

  /**
   * {@inheritdoc}
   */
  public function getOptions() {
    return $this->getInput()->getOptions();
  }

  /**
   * {@inheritdoc}
   */
  public function getSelectedOptions() {
    return $this->getInput()->getSelectedOptions();
  }

  /**
   * {@inheritdoc}
   */
  public function selectMultiple($multiple = true) {
    $this->getInput()->selectMultiple($multiple);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setSelectedValues($selectedValues) {
    $this->getInput()->setSelectedValues($selectedValues);
    return $this;
  }

}
