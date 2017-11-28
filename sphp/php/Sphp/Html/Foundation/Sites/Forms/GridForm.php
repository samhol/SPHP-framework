<?php

/**
 * GridForm.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use IteratorAggregate;
use Sphp\Html\Forms\TraversableFormInterface;
use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Grids\XY\GridInterface;
use Sphp\Html\Foundation\Sites\Grids\XY\RowInterface;
use Sphp\Html\Forms\TraversableFormTrait;
use Sphp\Html\Foundation\Sites\Containers\Callout;
use Sphp\Html\Foundation\Sites\Grids\XY\Grid;
use Sphp\Html\Forms\Inputs\HiddenInputs;

/**
 * Implements a framework form
 *
 * A {@link GridForm} is built with a combination of standard form
 * elements, as well as the Foundation Grid ({@link Row}(s) and {@link Column}(s)).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/docs/components/forms.html Foundation forms
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GridForm extends AbstractComponent implements IteratorAggregate, GridInterface, TraversableFormInterface {

  use TraversableFormTrait;

  /**
   * @var Callout
   */
  private $errorLabel;

  /**
   * @var Grid
   */
  private $gridContainer;

  /**
   * @var HiddenInputs
   */
  private $hiddenInputs;

  /**
   * Constructs a new instance
   *
   *  **Note:** The method attribute specifies how to send form-data
   *  (the form-data is sent to the page specified in the action attribute)
   *
   * @precondition `$method == get|post`
   * @param  string $action where to send the form-data when the form is submitted
   * @param  string $method how to send form-data
   * @param  mixed|null $content the content of the form or null for no content
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function __construct(string $action = null, string $method = null, $content = null) {
    parent::__construct('form');

    $this->gridContainer = new Grid();
    $this->hiddenInputs = new HiddenInputs();
    if ($action !== null) {
      $this->setAction($action);
    }
    if ($method !== null) {
      $this->setMethod($method);
    }
    if ($content !== null) {
      $this->append($content);
    }
    $this->errorLabel = new Callout('<i class="fi-alert"></i> There are some errors in your form.');
    $this->errorLabel->cssClasses()->protect('alert');
    $this->errorLabel->inlineStyles()->setProperty('display', 'none');
    $this->errorLabel->attrs()->demand('data-abide-error');
  }

  public function getGrid(): Grid {
    return $this->gridContainer;
  }

  public function getHiddenInputs(): HiddenInputs {
    return $this->hiddenInputs;
  }

  /**
   * 
   * @param  string $message
   * @return $this for a fluent interface
   */
  public function setFormErrorMessage($message) {
    $this->errorLabel->replaceContent($message);
    return $this;
  }

  public function validation(bool $validate = true) {
    $this->attrs()->set('novalidate', $validate)->set('data-abide', $validate);
    return $this;
  }

  public function contentToString(): string {
    return $this->errorLabel . $this->gridContainer . $this->getHiddenInputs();
  }

  /**
   * Appends a new {@link RowInterface} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link FormRow} component.
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return $this for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($row) {
    if (!($row instanceof RowInterface)) {
     // echo 'fooooooo'.$row;
      $row = new FormRow($row);
    }
    $this->getGrid()->append($row);
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
   * @return $this for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function prepend($row) {
    if (!($row instanceof RowInterface)) {
      $row = new FormRow($row);
    }
    $this->getGrid()->prepend($row);
    return $this;
  }

  public function count(): int {
    return $this->getGrid()->count();
  }

  public function getIterator() {
    return $this->getGrid()->getIterator();
  }

  /**
   * Appends a hidden variable into the form
   *
   * Appended <var>$name => $value</var> pair is stored into a
   *  {@link HiddenInput} object
   *
   * @param  string $name th name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return $this for a fluent interface
   * @see    HiddenInput
   */
  public function appendHiddenVariable($name, $value) {
    $this->getGrid()->append(new HiddenInput($name, $value));
    return $this;
  }

  /**
   * Appends the hidden data to the form
   *
   * Appended <var>$key => $value</var> pairs are stored into 
   *  {@link HiddenInput} components.
   *
   * @param  string[] $vars name => value pairs
   * @return $this for a fluent interface
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
   * @return ContainerInterface containing all the {@link ColumnInterface} components
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
