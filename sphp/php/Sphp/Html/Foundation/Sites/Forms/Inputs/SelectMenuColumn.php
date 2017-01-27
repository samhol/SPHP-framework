<?php

/**
 * SelectMenuColumn.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\Menus\SelectMenuInterface;
use Sphp\Html\Forms\Inputs\Menus\Select;
use IteratorAggregate;

/**
 * Implements framework based select menu input component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SelectMenuColumn extends InputColumn implements IteratorAggregate, SelectMenuInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   *
   * <var>$opt</var> parameter:
   * 
   * 1. a {@link SelectContentInterface} is stored as such
   * 2. a single dimensional array with $key => $val pairs corresponds to an 
   *    array of new {@link Option}($key, $val) objects
   * 3. a multidimensional array corresponds to a multidimensional menu structure with 
   *    {@link Optgroup} components containing new {@link Option}($key, $val) objects
   * 4. all other types are converted to strings and and stored as new 
   *    {@link Option}($opt, $opt) object
   *
   * @param  string|null $name name attribute
   * @param  mixed|mixed[] $opt the content of the menu
   * @param  string|string[] $selectedValues the optionvalues selected
   */
  public function __construct($name = null, $opt = null, $selectedValues = null) {
    parent::__construct(new Select($name, $opt, $selectedValues));
  }

  /**
   * Returns the actual input component
   * 
   * @return SelectMenuInterface the actual input component
   */
  public function getInput() {
    return parent::getInput();
  }

  public function setSize($size) {
    $this->getInput()->setSize($size);
    return $this;
  }

  public function isRequired() {
    return $this->getInput()->isRequired();
  }

  public function setRequired($required = true) {
    $this->getInput()->setRequired($required);
    return $this;
  }

  public function count() {
    return $this->getInput()->count();
  }

  public function getIterator() {
    return $this->getInput()->getIterator();
  }

  public function getOptions() {
    return $this->getInput()->getOptions();
  }

  public function getSelectedOptions() {
    return $this->getInput()->getSelectedOptions();
  }

  public function selectMultiple($multiple = true) {
    $this->getInput()->selectMultiple($multiple);
    return $this;
  }

  public function setSelectedValues($selectedValues) {
    $this->getInput()->setSelectedValues($selectedValues);
    return $this;
  }

}
