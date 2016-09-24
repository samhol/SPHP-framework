<?php

/**
 * FormGridTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\ContainerInterface;
use Sphp\Html\Foundation\F6\Grids\RowInterface;
use Sphp\Html\Foundation\F6\Grids\ColumnInterface;
use Sphp\Html\Forms\Inputs\HiddenInput;
use Sphp\Html\Foundation\F6\Forms\Inputs\InputColumnInterface;

/**
 * Trait implements {@link Sphp\Html\Foundation\F6\Grids\GridInterface} to be used with {@link FormInterface} etc.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-24
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait FormGridTrait {

  /**
   * Appends a new {@link RowInterface} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link FormRow} component.
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($row) {
    if (!($row instanceof RowInterface)) {
      $row = new FormRow($row);
    }
    $this->content()->append($row);
    return $this;
  }

  /**
   * Prepends a new {@link RowInterface} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link FormRow} component.
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function prepend($row) {
    if (!($row instanceof RowInterface)) {
      $row = new FormRow($row);
    }
    $this->content()->prepend($row);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    return $this->content()->count();
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return $this->content()->getIterator();
  }

  /**
   * Appends a hidden variable into the form
   *
   * Appended <var>$name => $value</var> pair is stored into a
   *  {@link HiddenInput} object
   *
   * @param  string $name th name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return self for PHP Method Chaining
   * @see    HiddenInput
   */
  public function appendHiddenVariable($name, $value) {
    $this->content()->append(new HiddenInput($name, $value));
    return $this;
  }

  /**
   * Appends the hidden data to the form
   *
   * Appended <var>$key => $value</var> pairs are stored into 
   *  {@link HiddenInput} components.
   *
   * @param  string[] $vars name => value pairs
   * @return self for PHP Method Chaining
   * @see    HiddenInput
   */
  public function appendHiddenVariables(array $vars) {
    foreach ($vars as $name => $value) {
      $this->appendHiddenVariable($name, $value);
    }
    return $this;
  }

  /**
   * Returns all {@link ColumnInterface} components from the grid
   * 
   * @return Container containing all the {@link ColumnInterface} components
   */
  public function getColumns() {
    return $this->getComponentsByObjectType(ColumnInterface::class);
  }

  /**
   * Returns all {@link InputColumnInterface} components from the grid
   * 
   * @return ContainerInterface containing all the {@link InputColumn} components
   */
  public function getInputColumns() {
    return $this->getComponentsByObjectType(InputColumnInterface::class);
  }

}
