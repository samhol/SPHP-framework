<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use IteratorAggregate;
use Sphp\Html\Forms\TraversableForm;
use Sphp\Html\Foundation\Sites\Grids\Grid;
use Sphp\Html\Foundation\Sites\Grids\Row;
use Sphp\Html\Forms\TraversableFormTrait;
use Sphp\Html\Foundation\Sites\Containers\ContentCallout;
use Sphp\Html\Foundation\Sites\Grids\DivGrid;
use Sphp\Html\Forms\Inputs\HiddenInputs;
use Sphp\Html\Forms\Inputs\HiddenInput;
use Sphp\Html\TraversableContent;

/**
 * Implements a framework form
 *
 * A {@link GridForm} is built with a combination of standard form
 * elements, as well as the Foundation Grid ({@link Row}(s) and {@link Column}(s)).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/docs/components/forms.html Foundation forms
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class GridForm extends \Sphp\Html\Foundation\Sites\Grids\AbstractGrid implements IteratorAggregate, Grid, TraversableForm {

  use TraversableFormTrait;

  /**
   * @var ContentCallout
   */
  private $errorLabel;

  /**
   * @var HiddenInputs
   */
  private $hiddenInputs;

  /**
   * Constructor
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
    $this->errorLabel = new ContentCallout('<i class="fas fa-exclamation-triangle"></i> There are some errors in your form.');
    $this->errorLabel->cssClasses()->protectValue('alert');
    $this->errorLabel->inlineStyles()->setProperty('display', 'none');
    $this->errorLabel->attributes()->demand('data-abide-error');
  }

  public function __destruct() {
    unset($this->hiddenInputs, $this->errorLabel);
    parent::__destruct();
  }

  public function useValidation(bool $validate = true) {
    $this->attributes()->setAttribute('novalidate', $validate)->setAttribute('data-abide', $validate);
    return $this;
  }

  public function validateOnBlur(bool $validate = true) {
    if ($validate) {
      $this->useValidation();
    }
    $this->attributes()->setAttribute('data-validate-on-blur', $validate ? 'true' : 'false');
    return $this;
  }

  public function liveValidate(bool $validate = true) {
    if ($validate) {
      $this->useValidation();
    }
    $this->attributes()->setAttribute('data-live-validate', $validate ? 'true' : 'false');
    return $this;
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
    $this->errorLabel->resetContent($message);
    return $this;
  }

  public function contentToString(): string {
    return $this->errorLabel . parent::contentToString() . $this->getHiddenInputs();
  }

  /**
   * Appends a new {@link RowInterface} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link FormRow} component.
   *
   * @param  mixed|Row $row the new row or the content of the new row
   * @return Row for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($row): Row {
    if (!($row instanceof Row)) {
      // echo 'fooooooo'.$row;
      $row = new FormRow($row);
    }
    parent::append($row);
    return $row;
  }

  /**
   * Prepends a new {@link RowInterface} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link FormRow} component.
   *
   * @param  mixed|Row $row the new row or the content of the new row
   * @return $this for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function prepend($row) {
    if (!($row instanceof Row)) {
      $row = new FormRow($row);
    }
    parent::prepend($row);
    return $this;
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
  public function appendHiddenVariable($name, $value): HiddenInput {
    $input = new HiddenInput($name, $value);
    $this->hiddenInputs()->append($input);
    return $input;
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
   * @return TraversableContent containing all the {@link ColumnInterface} components
   */
  public function getCells(): TraversableContent {
    return $this->getComponentsByObjectType(Cell::class);
  }

  /**
   * Returns all {@link InputCell} components from the grid
   * 
   * @return TraversableContent containing all the {@link InputColumn} components
   */
  public function getInputColumns(): TraversableContent {
    return $this->getComponentsByObjectType(InputCell::class);
  }

}
