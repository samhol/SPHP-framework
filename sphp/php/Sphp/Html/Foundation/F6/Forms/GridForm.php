<?php

/**
 * GridForm.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\TraversableFormInterface as TraversableFormInterface;
use Sphp\Html\AbstractContainerComponent as AbstractContainerComponent;
use Sphp\Html\Foundation\F6\Core\GridInterface as GridInterface;
use Sphp\Html\Forms\TraversableFormTrait as TraversableFormTrait;
use Sphp\Html\ContentTrait as ContentTrait;
use Sphp\Html\Forms\Input\HiddenInput as HiddenInput;

/**
 * Class implements a Foundation framework form
 *
 * A {@link GridForm} is built with a combination of standard form
 * elements, as well as the Foundation Grid ({@link Row}(s) and {@link Column}(s)).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-16
 * @link    http://foundation.zurb.com/docs/components/forms.html Foundation forms
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GridForm extends AbstractContainerComponent implements GridInterface, TraversableFormInterface {

  use ContentTrait,
      FormGridTrait,
      TraversableFormTrait;

  /**
   * Constructs a new instance of the {@link self} object
   *
   *  **Note:** The method attribute specifies how to send form-data
   *  (the form-data is sent to the page specified in the action attribute)
   *
   * @precondition `$method == "get" | $method == "post"`
   *
   * @param  string $action where to send the form-data when the form is submitted
   * @param  string $method how to send form-data
   * @param  mixed $content the content of the form
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function __construct($action = "", $method = "post", $content = null) {
    parent::__construct("form");
    if ($action != "") {
      $this->setAction($action);
    }
    if ($method != "") {
      $this->setMethod($method);
    }
    if ($content !== null) {
      $this->append($content);
    }
  }

  /**
   * Appends a new {@link Row} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link Row} is wrapped inside a {@link Row} component 
   *   using {@link self::toRow()} method.
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($row) {
    if (!($row instanceof Row)) {
      $row = new FormRow($row);
    }
    $this->content()->append($row);
    return $this;
  }

  /**
   * Prepends a new {@link Row} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link Row} is wrapped inside a {@link Row} component 
   *   using {@link self::toRow()} method.
   * * The numeric keys of the content will be renumbered starting from zero 
   *    and the index of the prepended row is 'int(0)' 
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function prepend($row) {
    if (!($row instanceof Row)) {
      $row = new FormRow($row);
    }
    $this->content()->prepend($row);
    return $this;
  }

  public function count() {
    return $this->content()->count();
  }

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

}
