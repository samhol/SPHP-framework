<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag;
use Sphp\Html\Forms\Inputs\HiddenInput;

/**
 * Implements an HTML &lt;form&gt; tag
 *
 * The form element represents a collection of form-associated elements, some
 * of which can represent editable values that can be submitted to a server
 * for processing.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Form extends ContainerTag implements TraversableForm {

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
   * @param  string|null $method how to send form-data
   * @param  mixed $content tag's content
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function __construct(string $action = null, string $method = null, $content = null) {
    parent::__construct('form');
    if ($content !== null) {
      $this->append($content);
    }
    if ($action !== null) {
      $this->setAction($action);
    }
    if ($method !== null) {
      $this->setMethod($method);
    }
  }

  /**
   * Appends a hidden variable to the form
   *
   * The `$name => $value` pair is stored into a {@link HiddenInput} component.
   *
   * @param  string $name th name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return $this for a fluent interface
   * @see    HiddenInput
   */
  public function appendHiddenVariable($name, $value):HiddenInput {
    $input = new HiddenInput($name, $value);
    $this->append($input);
    return $input;
  }

  /**
   * Appends the hidden data to the form
   *
   * Appended `$key => $value` pairs are stored into 
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

}
