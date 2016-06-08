<?php

/**
 * AbstractForm.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag as ContainerTag;
use Sphp\Html\Forms\Input\HiddenInput as HiddenInput;
use Sphp\Html\ContainerInterface as ContainerInterface;

/**
 * Class Models an HTML &lt;form&gt; tag
 *
 * The form element represents a collection of form-associated elements, some
 * of which can represent editable values that can be submitted to a server
 * for processing.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractForm extends ContainerTag implements FormInterface {

  use FormTrait;

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "form";

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
   * @precondition `$method == "get" | $method == "post"`
   * 
   * @param  string $action where to send the form-data when the form is submitted
   * @param  string $method how to send form-data
   * @param  mixed $content tag's content
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function __construct($action = "", $method = "get", $content = null) {
    parent::__construct(self::TAG_NAME);
    if ($content !== null) {
      $this->append($content);
    }
    if ($action != "") {
      $this->setAction($action);
    }
    if ($method != "") {
      $this->setMethod($method);
    }
  }

  /**
   * Sets the values to the input fields
   *
   * **Important:** Works only for sigle dimensional input names
   * 
   * @param  mixed[] $data
   * @param  boolean $filter true for enabling the data filtering, ans false otherwise
   * @return self for PHP Method Chaining
   */
  public function setData(array $data = [], $filter = true) {
    if ($filter) {
      $data = filter_var_array($data, \FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      //print_r($data);
    }
    foreach ($this->getNamedInputComponents() as $input) {
      $inputName = $input->getName();
      if (array_key_exists($inputName, $data)) {
        $input->setValue($data[$inputName]);
      }
    }
    return $this;
  }

  /**
   * Returns the data presented in the input fields of the form
   * 
   * @return mixed[] the data object
   */
  public function getData() {
    $data = [];
    foreach ($this->getNamedInputComponents() as $val) {
      $a = [];
      parse_str($val->getName() . "=" . $val->getValue(), $a);
      $data = array_merge($data, $a);
    }
    return $data;
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

  /**
   * Returns all named {@link InputInterface} components in the form
   *
   * @return ContainerInterface containing matching sub components
   */
  public function getNamedInputComponents() {
    $search = function($element) {
      if ($element instanceof InputInterface && $element->isNamed()) {
        return true;
      } else {
        return false;
      }
    };
    return $this->getComponentsBy($search);
  }

  /**
   * Returns all named {@link HiddenInput} components from the form
   *
   * @return ContainerInterface containing matching sub components
   */
  public function getHiddenInputs() {
    $search = function($element) {
      if ($element instanceof HiddenInput) {
        return true;
      } else {
        return false;
      }
    };
    return $this->getComponentsBy($search);
  }

  /**
   * Sets the form as validable
   * 
   * @param  boolean $validable
   * @return self for PHP Method Chaining
   */
  public function validable($validable = true) {
    return $this->setAttr("data-sphp-validate", $validable);
  }

}
