<?php

/**
 * Form.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag;
use Sphp\Html\Forms\Inputs\HiddenInput;

/**
 * Class Models an HTML &lt;form&gt; tag
 *
 * The form element represents a collection of form-associated elements, some
 * of which can represent editable values that can be submitted to a server
 * for processing.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Form extends ContainerTag implements TraversableFormInterface {

  use TraversableFormTrait;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class that
   * implements magic method `__toString()` is allowed.
   *
   *  **Note:** The method attribute specifies how to send form-data
   *  (the form-data is sent to the page specified in the action attribute)
   *
   * @precondition `$method == "get|post"`
   * @param  string|null $action where to send the form-data when the form is submitted
   * @param  string $method how to send form-data
   * @param  mixed $content tag's content
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function __construct($action = null, $method = "post", $content = null) {
    parent::__construct('form');
    if ($content !== null) {
      $this->append($content);
    }
    if ($action !== null) {
      $this->setAction($action);
    }
    if ($method != "") {
      $this->setMethod($method);
    }
  }

  /**
   * Appends a hidden variable to the form
   *
   * The <var>$name => $value</var> pair is stored into a {@link HiddenInput} component.
   *
   * @param  string $name th name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return self for PHP Method Chaining
   * @see    HiddenInput
   */
  public function appendHiddenVariable($name, $value) {
    $this->append(new HiddenInput($name, $value));
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
